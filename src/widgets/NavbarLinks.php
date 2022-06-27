<?php

namespace ashtokalo\yii2\adminlte\widgets;

class NavbarLinks extends Menu
{
    public string $template = '<ul class="navbar-nav ml-auto">{items}</ul>';
    public string $itemTemplate = '<li class="nav-item">{item}</li>';
    public string $headerTemplate = '<li class="nav-item">{item}</li>';
    public string $dropdownItemTemplate = '<li class="nav-item dropdown">{item}</li>';
    public $defaultItemConfig = NavbarLink::class;
}