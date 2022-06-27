<?php

namespace ashtokalo\yii2\adminlte\widgets;

class SidebarBadge extends Widget
{
    public $avatar = '';
    public $name = '';
    public $url = '';
    public $viewName = 'sidebar-user-panel';

    protected function renderWidget(): string
    {
        return $this->render($this->viewName, [
            'avatar' => \Yii::getAlias($this->avatar),
            'name' => $this->name,
            'url' => $this->url,
        ]);
    }
}