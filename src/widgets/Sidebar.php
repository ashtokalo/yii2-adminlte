<?php

namespace ashtokalo\yii2\adminlte\widgets;

class Sidebar extends Collection
{
    public $header = SidebarLogo::class;
    public $footer = SidebarCustom::class;
    public $defaultItemConfig = [
        'class' => Menu::class,
        'template' => '<nav class="mt-2"><ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">{items}</ul></nav>',
    ];
    public string $sidebarTemplate = '<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">{header}<div class="sidebar">{items}</div>{footer}</aside>';

    public function init()
    {
        parent::init();
        $this->initWidgets();
    }

    protected function initWidgets()
    {
        if ($this->header && !is_object($this->header)) $this->header = \Yii::createObject($this->header);
        if ($this->footer && !is_object($this->footer)) $this->footer = \Yii::createObject($this->footer);
    }

    protected function renderWidget(): string
    {
        $this->initWidgets();
        $template = $this->sidebarTemplate;
        if (!$this->footer) $template = str_replace('main-sidebar-custom', '', $template);
        return strtr($template, [
            '{header}' => $this->header ? static::widget($this->header) : '',
            '{items}' => parent::renderWidget(),
            '{footer}' => $this->footer ? static::widget($this->footer) : '',
        ]);
    }
}