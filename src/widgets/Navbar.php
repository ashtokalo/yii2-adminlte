<?php

namespace ashtokalo\yii2\adminlte\widgets;

use ashtokalo\yii2\adminlte\Module;

class Navbar extends Collection
{
    public string $template = '<nav class="main-header navbar navbar-expand navbar-white navbar-light">{items}</nav>';
    public $defaultItemConfig = [
        'class' => \ashtokalo\yii2\adminlte\widgets\Menu::class,
        // first level
        'template' => '<ul class="navbar-nav">{items}</ul>',
        'itemTemplate' => '<li class="nav-item">{item}</li>',
        'dropdownItemTemplate' => '<li class="nav-item dropdown">{item}</li>',
        'headerTemplate' => '<li class="nav-item">{item}</li>',
        'defaultItemConfig' => [
            'class' => MenuItem::class,
            // first level items
            'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
            'activeTemplate' => '<a href="{url}" class="nav-link active">{label}</a>',
            'dropdownLinkTemplate' => '<a href="{url}" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button">{label}</a>{subitems}',
            'dropdownActiveTemplate' => '<a href="{url}" class="nav-link dropdown-toggle active" data-toggle="dropdown" role="button">{label}</a>{subitems}',
            'labelTemplate' => '{label}',
            // second level (sub menu from horizontal menu)
            'template' => '<ul class="dropdown-menu border-0 shadow">{items}</ul>',
            'itemTemplate' => '<li>{item}</li>',
            'dropdownItemTemplate' => '<li class="dropdown-submenu dropdown-hover">{item}</li>',
            'defaultItemConfig' => [
                'class' => MenuItem::class,
                // second level items
                'linkTemplate' => '<a href="{url}" class="dropdown-item">{label}</a>',
                'activeTemplate' => '<a href="{url}" class="dropdown-item active">{label}</a>',
                'dropdownLinkTemplate' => '<a href="{url}" class="dropdown-item dropdown-toggle" data-toggle="dropdown">{label}</a>{subitems}',
                'dropdownActiveTemplate' => '<a href="{url}" class="dropdown-item dropdown-toggle active" data-toggle="dropdown">{label}</a>{subitems}',
                'labelTemplate' => '{label}',
                // third level (sub menu from sub menu)
                'template' => '<ul class="dropdown-menu border-0 shadow">{items}</ul>',
                'itemTemplate' => '<li>{item}</li>',
                'dropdownItemTemplate' => '<li class="dropdown-submenu">{item}</li>',
                'defaultItemConfig' => [
                    'class' => MenuItem::class,
                    // third level items
                    'linkTemplate' => '<a href="{url}" class="dropdown-item">{label}</a>',
                    'activeTemplate' => '<a href="{url}" class="dropdown-item active">{label}</a>',
                    'dropdownLinkTemplate' => '<a href="{url}" class="dropdown-item dropdown-toggle" data-toggle="dropdown">{label}</a>{subitems}',
                    'dropdownActiveTemplate' => '<a href="{url}" class="dropdown-item dropdown-toggle active" data-toggle="dropdown">{label}</a>{subitems}',
                    'labelTemplate' => '{label}',
                    // forth level (sub menu from sub menu)
                    'template' => '<ul class="dropdown-menu border-0 shadow">{items}</ul>',
                    'itemTemplate' => '<li>{item}</li>',
                    'dropdownItemTemplate' => '<li class="dropdown-submenu">{item}</li>',
                    'defaultItemConfig' => [
                        'class' => MenuItem::class,
                        // forth level items
                        'linkTemplate' => '<a href="{url}" class="dropdown-item">{label}</a>',
                        'activeTemplate' => '<a href="{url}" class="dropdown-item active">{label}</a>',
                        'dropdownLinkTemplate' => '<a href="{url}" class="dropdown-item dropdown-toggle" data-toggle="dropdown">{label}</a>{subitems}',
                        'dropdownActiveTemplate' => '<a href="{url}" class="dropdown-item dropdown-toggle active" data-toggle="dropdown">{label}</a>{subitems}',
                        'labelTemplate' => '{label}',
                    ],
                ],
            ],
        ]
    ];

    protected function renderWidget(): string
    {
        if (Module::$instance->wideLayout === false && Module::$instance->boxed === false) {
            $this->template = strtr($this->template, ['{items}' => '<div class="container">{items}</div>']);
        }
        return parent::renderWidget();
    }
}