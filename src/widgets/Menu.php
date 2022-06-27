<?php

namespace ashtokalo\yii2\adminlte\widgets;

use yii\base\Widget;

class Menu extends Collection
{
    public $defaultItemConfig = MenuItem::class;
    public string $itemTemplate = '<li class="nav-item">{item}</li>';
    public string $dropdownItemTemplate = '<li class="nav-item">{item}</li>';
    public string $headerTemplate = '<li class="nav-header">{item}</li>';
    public string $expandedItemTemplate = '<li class="nav-item menu-is-opening menu-open">{item}</li>';
    public string $template = '<ul class="navbar-nav">{items}</ul>';

    protected function renderItem($out, $name, Widget $widget)
    {
        $template = $this->itemTemplate;
        if ($widget instanceof MenuItem) {
            if ($this->dropdownItemTemplate && $widget->hasVisibleSubItems()) $template = $this->dropdownItemTemplate;
            if ($this->expandedItemTemplate && $widget->isExpanded()) $template = $this->expandedItemTemplate;
            if (!$widget->url && $this->headerTemplate && !$widget->hasVisibleSubItems()) $template = $this->headerTemplate;
        } else {
            $template = $this->headerTemplate;
        }
        return strtr($template, ['{item}' => $out]);
    }
}