<?php

namespace ashtokalo\yii2\adminlte\widgets;

class NavbarFullscreen extends Widget
{
    protected function renderWidget(): string
    {
        return <<<HTML
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
HTML;

    }
}