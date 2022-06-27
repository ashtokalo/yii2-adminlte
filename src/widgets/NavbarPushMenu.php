<?php

namespace ashtokalo\yii2\adminlte\widgets;

class NavbarPushMenu extends Widget
{
    protected function renderWidget(): string
    {
        return '<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>';
    }
}