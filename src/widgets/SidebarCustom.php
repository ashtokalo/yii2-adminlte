<?php

namespace ashtokalo\yii2\adminlte\widgets;

class SidebarCustom extends Widget
{
    protected function renderWidget(): string
    {
        return <<<HTML
    <div class="sidebar-custom">
      <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
      <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div>
HTML;

    }
}