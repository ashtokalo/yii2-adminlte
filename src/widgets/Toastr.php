<?php

namespace ashtokalo\yii2\adminlte\widgets;

use ashtokalo\yii2\adminlte\assets\AdminLteToastrAsset;

class Toastr extends Widget
{
    public $types = [
        'error' => 'error',
        'info' => 'info',
        'warning' => 'warning',
        'success' => 'success',
    ];

    public $defaultType = 'warning';

    // toastr options:
    public bool $closeButton = false;
    public bool $newestOnTop = false;
    public bool $progressBar = true;
    public string $positionClass = 'toast-top-right';
    public bool $preventDuplicates = false;
    public int $showDuration = 300;
    public int $hideDuration = 100;
    public int $timeOut = 5000;
    public int $extendedTimeOut = 1000;
    public string $showEasing = 'swing';
    public string $hideEasing = 'linear';
    public string $showMethod = 'fadeIn';
    public string $hideMethod = 'fadeOut';

    public function init()
    {
        parent::init();
        $view = $this->view ?: \Yii::$app->view;
        AdminLteToastrAsset::register($view);

        $optionNames = ['closeButton', 'newestOnTop', 'progressBar', 'positionClass', 'preventDuplicates', 'showDuration',
            'hideDuration', 'timeOut', 'extendedTimeOut', 'showEasing', 'hideEasing', 'showMethod', 'hideMethod'];
        $options = [];
        foreach ($optionNames as $option) $options[$option] = $this->$option;
        $view->registerJs('adminlte = toastr; toastr.options=' . json_encode($options) . ';');
    }

    protected function renderWidget(): string
    {
        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();
        $view = $this->view ?: \Yii::$app->view;
        $messages = [];
        foreach ($flashes as $type => $data) {
            $action = $this->types[$type] ?? $this->defaultType;
            $data = !is_array($data) ? [$data] : $data;
            foreach ($data as $message) $messages[] = sprintf('toastr.%s(%s);', $action, json_encode($message));
        }
        $view->registerJs(implode(';', $messages));

        return parent::renderWidget();
    }
}