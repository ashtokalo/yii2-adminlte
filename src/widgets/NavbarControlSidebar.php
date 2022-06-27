<?php

namespace ashtokalo\yii2\adminlte\widgets;

class NavbarControlSidebar extends Widget
{
    protected function renderWidget(): string
    {
        return '<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>';
    }
}