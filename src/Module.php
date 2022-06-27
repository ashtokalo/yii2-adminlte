<?php

namespace ashtokalo\yii2\adminlte;

use ashtokalo\yii2\adminlte\widgets\Toastr;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;

/**
 *
 */
class Module extends \yii\base\Module
{
    public $defaultRoute = 'dashboard';
    /**
     * @var string Name of layout file to render the page. It could be configured through other options of this module.
     */
    public $layout = 'main';
    /**
     * @var bool TRUE if content must take entire page width, FALSE otherwise, to take central part only.
     */
    public bool $wideLayout = true;
    /**
     * @var bool TRUE central part must be surrounded with a box, FALSE to use entire page width for background.
     */
    public bool $boxed = false;
    /**
     * @var bool TRUE if navbar must be fixed while the page scrolled up and down, FALSE otherwise.
     */
    public bool $fixedNavbar = true;
    /**
     * @var bool TRUE if footer must be fixed while the page scrolled up and down, FALSE otherwise.
     */
    public bool $fixedFooter = false;
    /**
     * @var bool TRUE if collapsed sidebar must be visible as columns with icons, FALSE to make it completelt invisible.
     */
    public bool $miniSidebar = true;
    /**
     * @var bool TRUE if sidebar must appear collapsed, FALSE to show expanded sidebar.
     */
    public bool $collapsedSidebar = false;

    /**
     * @var string|array|Widget configuration or Widget object to render navbar element, set to empty string to remove
     * navbar. While string used, it first checks if the component with this id exists and can be used as Widget.
     */
    public $navbar = 'navbar';
    /**
     * @var string|array|Widget configuration or Widget object to render sidebar element, set to empty string to remove
     * sidebar. While string used, it first checks if the component with this id exists and can be used as Widget.
     */
    public $sidebar = 'sidebar';
    /**
     * @var string|array|Widget configuration or Widget object to render footer element, set to empty string to remove
     * footer. While string used, it first checks if the component with this id exists and can be used as Widget.
     */
    public $footer = [
        'class' => widgets\Widget::class,
        'template' => '<div class="float-right d-none d-sm-block"><b>Version</b> 3.2.0</div><strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.',
    ];
    /**
     * @var string|array|Widget configuration or Widget object to render flesh messages. While string used, it first
     * checks if the component with this id exists and can be used as Widget.
     */
    public $alerts = Toastr::class;

    public static ?Module $instance;

    public function init()
    {
        parent::init();
        self::$instance = $this;
        // share AdminLTE theme with application
        \Yii::$app->layoutPath = $this->getLayoutPath();
        \Yii::$app->layout = $this->layout;
    }

    public function renderSidebar(): string
    {
        return ($widget = $this->getWidget($this->sidebar)) ? ($this->sidebar = $widget)->run() : '';
    }

    public function renderNavbar(): string
    {
        return ($widget = $this->getWidget($this->navbar)) ? ($this->navbar = $widget)->run() : '';
    }

    public function renderFooter(): string
    {
        return ($widget = $this->getWidget($this->footer)) ? ($this->footer = $widget)->run() : '';
    }

    public function renderAlerts(): string
    {
        return ($widget = $this->getWidget($this->alerts)) ? ($this->alerts = $widget)->run() : '';
    }

    /**
     * Returns Widget instance from given configuration.
     *
     * @param string|array|Widget $value When string is used, it might be component name based on Widget class, or
     * name of class to create Widget object. When used array, it must be valid configuration to create widget instance
     * with [[Yii::createObject]]. When Widget object is used, it returned as is.
     *
     * @return Widget|null
     */
    protected function getWidget($value): ?Widget {
        if ($value) {
            if (is_object($value) && $value instanceof Widget) {
                return $value;
            } else if (is_string($value) && \Yii::$app->has($value)) {
                $widget = \Yii::$app->get($value);
                if ($widget instanceof Widget) return $widget;
            } else {
                try {
                    if (is_object($widget = @\Yii::createObject($value)) && $widget instanceof Widget) return $widget;
                } catch (InvalidConfigException $e) {
                    \Yii::warning(sprintf('%s: Expected object config, but found: %s', __METHOD__,
                        is_scalar($value) ? $value : (is_array($value) ? print_r($value, true) : serialize($value))));
                }
            }
        }
        return null;
    }

    /**
     * Returns list of classes required to configure layout.
     *
     * @param string|array optional, class names as a string or an array to merge
     *
     * @return string list of classes that must be used in body
     */
    public function getBodyClasses(): string
    {
        $layout = $this->wideLayout ? 'layout-fixed' : ($this->boxed ? 'layout-boxed' : 'layout-top-nav');
        if ($layout !== 'layout-boxed' && $this->fixedNavbar && $this->getWidget($this->navbar)) $layout .= ' layout-navbar-fixed';
        if ($this->fixedFooter && $this->getWidget($this->footer)) $layout .= ' layout-footer-fixed';
        if ($this->miniSidebar && $this->getWidget($this->sidebar)) $layout .= ' sidebar-mini';
        if ($this->collapsedSidebar && $this->getWidget($this->sidebar)) $layout .= ' sidebar-collapse';
        $options = ['class' => $layout];
        foreach (func_get_args() as $class) {
            Html::addCssClass($options, is_string($class) ? explode(' ', $class) : $class);
        }
        return $options['class'];
    }
}