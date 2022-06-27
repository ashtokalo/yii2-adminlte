<?php

namespace ashtokalo\yii2\adminlte\widgets;

use yii\web\AssetBundle;

class Widget extends \yii\base\Widget
{
    /**
     * @var bool|callable Optional, if set to TRUE or FALSE then widget will be rendered or not. When using a closure,
     * its signature should be `function (Widget $widget):bool`.
     */
    public $visible = true;
    /**
     * @var string Optional, template to render widget if it assumes some customization.
     */
    public string $template = '';
    /**
     * @var array Optional, list of required asset bundles. When key starts with sign `@` the key will be used as alias
     * to base url of registered bundle.
     */
    public array $assets = [];
    /**
     * @var mixed Optional, the name of the permission to be checked against with [[CheckAccessInterface::checkAccess]].
     */
    public string $permission = '';
    /**
     * @var array Optional, name-value pairs that will be passed to the rules associated with the roles and permissions
     * assigned to the user.
     */
    public array $permissionParams = [];

    public function beforeRun()
    {
        $this->registerAssets();
        return parent::beforeRun();
    }

    protected function registerAssets()
    {
        $aliases = [];
        foreach ($this->assets as $alias => $asset) {
            $bundle = call_user_func([$asset, 'register'], $this->view ?: \Yii::$app->view);
            if ($bundle instanceof AssetBundle && is_string($alias) && $alias[0] === '@') $aliases[$alias] = $bundle->baseUrl;
        }
        if ($aliases) \Yii::$app->setAliases($aliases);
    }

    public function run()
    {
        return $this->isVisible() ? $this->renderWidget() : '';
    }

    protected function renderWidget(): string
    {
        return $this->template;
    }

    /**
     * Creates a widget instance or use passed one to run it.
     *
     * @param string|array|\yii\base\Widget $config configuration to create widget or widget object
     * @return string
     * @throws \Exception
     */
    public static function widget($config = [])
    {
        if (is_object($widget = $config) && $widget instanceof \yii\base\Widget)
        {
            ob_start();
            ob_implicit_flush(false);
            $out = '';
            try {
                if ($widget->beforeRun()) {
                    $result = $widget->run();
                    $out = $widget->afterRun($result);
                }
            } catch (\Exception $e) {
                // close the output buffer opened above if it has not been closed already
                if (ob_get_level() > 0) ob_end_clean();
                throw $e;
            }
            return ob_get_clean() . $out;
        }
        return parent::widget($config);
    }

    public function hasPermission(): bool
    {
        return empty($this->permission) || !property_exists(\Yii::$app->user, 'accessChecker')
            || empty($checker = \Yii::$app->user->accessChecker)
            || $checker->checkAccess(\Yii::$app->user->id, $this->permission, $this->permissionParams);
    }

    public function isVisible(): bool
    {
        return !!($this->hasPermission() && $this->getCallableValue($this->visible));
    }

    protected function getCallableValue($value)
    {
        return is_callable($value) ? call_user_func($value, $this) : $value;
    }
}