<?php

namespace ashtokalo\yii2\adminlte\widgets;

use yii\helpers\Url;

class SidebarLogo extends Widget
{
    public $name;
    public $logo;
    public $url;

    public string $template = '<a href="{url}" class="brand-link"><img src="{logo}" alt="{name}" class="brand-image img-circle elevation-3" style="opacity: .8"><span class="brand-text font-weight-light">{name}</span></a>';

    protected function renderWidget(): string
    {
        return strtr($this->template, [
            '{url}' => Url::to($this->url ?: \Yii::$app->homeUrl),
            '{logo}' => \Yii::getAlias($this->logo),
            '{name}' => $this->name ?: \Yii::$app->name,
        ]);
    }
}