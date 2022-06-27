<?php

namespace ashtokalo\yii2\adminlte\widgets;

class ControlSidebar extends Sidebar
{
    public $header = null;
    public $footer = null;
    public $defaultItemConfig = [
        'class' => Menu::class,
        'template' => '<nav class="mt-2"><ul class="nav nav-pills control-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">{items}</ul></nav>',
    ];
    public string $sidebarTemplate = '<aside class="control-sidebar control-sidebar-dark">{header}<div class="sidebar">{items}</div>{footer}</aside>';
}