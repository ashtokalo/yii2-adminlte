<?php

namespace ashtokalo\yii2\adminlte\widgets;

use ashtokalo\yii2\adminlte\assets\AdminLteDataTablesAsset;
use ashtokalo\yii2\adminlte\assets\AdminLteDataTablesButtonsAsset;
use ashtokalo\yii2\adminlte\assets\AdminLteDataTablesSelectAsset;
use ashtokalo\yii2\adminlte\helpers\DataTableHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

/**
 * @property bool $select
 * @property bool $responsive
 *
 * @property array $buttons Optional, list of action buttons, see plugin [[https://datatables.net/reference/button/]].
 * Each button could be a string with name of built-in button, e.g. 'colvis' or an array with following button config:
 *
 * - `text` - the text on button;
 * - `className` - name of classes, by default it `btn btn-default`;
 * - `url` - the url to go if button clicked, processed with [[Url::to]];
 * - `visible` - optional, by default is TRUE, TRUE if button must be rendered, FALSE otherwise;
 * - `action` - the \yii\web\JsExpression with callback function `function (e, dt, node, config)`, see more detalis at
 * original documenation - [[https://datatables.net/reference/option/buttons.buttons.action]].
 *
 * When `url` is defined, it allows use tokens like `{column}` inside URL. Each token will be replaced with value of
 * the column from selected row. So, there are two extra options might be used in button config:
 *
 * - `messageSelectRow` - the message appears if nothing selected when button has been pressed;
 * - `messageSelectOneRow` - the message appears if selected more than one row;
 *
 * When buttons used, the `B` token must be placed into [[static::$dom]] option, e.g. `Blfrtip`. If the buttons used and
 * `B` token absent, following preset will be used:
 *
 *      <"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"p>>i
 *
 */
class DataTable extends \nullref\datatable\DataTable
{
    public string $defaultButtonsDom = '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"p>>i';
    public string $defaultAjaxError = 'Unable to get data. Check the connection or contact support.';
    /**
     * @var string Optional, alternative placeholder for search field.
     */
    public string $searchPlaceholder = '';

    public function __construct($config = [])
    {
        $this->language = DataTableHelper::language();
        parent::__construct($config);
    }

    public function beforeRun()
    {
        AdminLteDataTablesAsset::register($this->view ?: \Yii::$app->view);
        if ($this->select) AdminLteDataTablesSelectAsset::register($this->view ?: \Yii::$app->view);
        if ($this->buttons) AdminLteDataTablesButtonsAsset::register($this->view ?: \Yii::$app->view);

        $ajax = $this->ajax ?: [];
        if ($ajax && !is_array($ajax) && !($ajax instanceof JsExpression)) {
            $ajax = ['url' => $ajax];
            if (!is_bool($this->serverSide)) $this->serverSide = true;
        }

        if (!is_bool($this->autoWidth)) $this->autoWidth = false;

        if ($this->searchPlaceholder) {
            $language = $this->language;
            $language['searchPlaceholder'] = $this->searchPlaceholder;
            $this->language = $language;
        }

        $tableOptions = $this->tableOptions ?: [];
        if (!isset($tableOptions['class'])) $tableOptions['class'] = 'table table-bordered';
        $this->tableOptions = $tableOptions;

        if (is_array($ajax) && (!isset($ajax['error']) || !$ajax['error'])) {
            $message = json_encode($this->language['ajaxError'] ?? $this->defaultAjaxError);
            $ajax['error'] = new \yii\web\JsExpression("
                function (xhr, testStatus, errorThrow) {
                    console.log(errorThrow);
                    adminlte.error($message);
                    return true;
                }");
            $this->ajax = $ajax;
        }
//        throw new \Exception((is_array($ajax) && (!isset($ajax['error']) || !$ajax['error']) ? 1 : 0) . print_r($ajax, true));

        return parent::beforeRun();
    }

    public function __set($name, $value)
    {
        if ($name === 'buttons') $value = $this->beforeButtonsSet($value);

        return parent::__set($name, $value);
    }

    private function beforeButtonsSet($value)
    {
        $buttons = [];
        foreach ($value as &$button) {
            if ($button === 'colvis') {
                $button = ['extend' => 'colvis'];
            }
            if (is_array($button)) {
                if (array_key_exists('visible', $button)) {
                    if (!$button['visible']) continue;
                    unset($button['visible']);
                }
                if (!isset($button['className'])) {
                    $button['className'] = 'btn btn-default';
                }
                if (isset($button['url'])) {
                    $button = $this->prepareButtonUrl($button);
                }
            }
            $buttons[] = $button;
        }

        if (empty($this->dom) || strpos('B', $this->dom) === false) {
            $this->dom = $this->defaultButtonsDom;
        }

        return $buttons;
    }

    protected function prepareButtonUrl($button)
    {
        $url = json_encode(Url::to($button['url']));
        unset($button['url']);
        // enable select feature, because the url contains tokens like `{column_id}`
        if (preg_match('/\{\w+\}/', $url) && !isset($this->select) || !$this->select) $this->enableSelect();
        // message 1
        $messageSelectRow = $this->getMessage('selectRow', 'Please select a row', $button);
        $messageSelectOneRow = $this->getMessage('selectOneRow', 'Please select one row only', $button);
        $button['action'] = new JsExpression("
            function (e, dt, node, config) {                         
                let url = $url, keys = url.match(/(?<=\{)(\w+)(?=\})/g),
                    selected = keys.length ? dt.rows( { selected: true } ).data() : [];
                if (keys.length) {
                    if (selected.length === 0) alert($messageSelectRow);
                    else if (selected.length > 1) alert($messageSelectOneRow);
                    else {
                        console.log(selected[0]);
                        for (let key in selected[0]) url = url.replace('{' + key + '}', selected[0][key]); 
                        location.href = url;
                    };
                } else {
                    location.href = url;
                }
            }");

        return $button;
    }

    protected function getMessage($messageId, $defaultMessage, &$button)
    {
        $message = $this->language['select'][$messageId] ?? $defaultMessage;
        if (isset($button[$messageId])) {
            $message = $button[$messageId];
            unset($button[$messageId]);
        }
        return json_encode($message);
    }

    public function __isset($name)
    {
        return isset($this->_options[$name]);
    }

    private function enableSelect()
    {
        $select = $this->select ?: [];
        if ($select && !is_array($select)) $select = [];
        if (!isset($select['info'])) $select['info'] = false;
        if (!isset($select['blurable'])) $select['blurable'] = false;
        $this->select = $select;
    }
}
