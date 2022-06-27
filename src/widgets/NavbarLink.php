<?php

namespace ashtokalo\yii2\adminlte\widgets;

use yii\helpers\Url;

class NavbarLink extends Collection
{
    /**
     * @var string|callable class name of icon from Font Awesome set, e.g. `fa-search`. When using a closure, its
     * signature should be `function (MenuItem $item)` and returned value must be string or null if no icon required.
     */
    public $icon;
    /**
     * @var string|callable optional, text in badge, the badge will not be rendered if empty text given. When using a
     * closure, its signature should be `function (MenuItem $item):string` with empty string if badge not required.
     */
    public $badge;
    /**
     * @var string|callable optional, CSS class names to decorate badge, `badge-info` used by default. When using a
     * closure, its signature should be `function (MenuItem $item):string` with empty string if badge not required.
     */
    public $style;
    /**
     * @var string|callable optional, popup text that appears on mouse over. When using a closure, its signature
     * should be `function (MenuItem $item):string` with empty string if title not required.
     */
    public $title = '';
    /**
     * @var string|callable optional, specifies the URL to go on click. It will be processed by [[Url::to]]. Used only
     * if [[items]] is empty. When using a closure, its signature should be `function (MenuItem $item):string`.
     */
    public $url;
    /**
     * @var string template used to render static element without any url or widget. Replace tokens `{title}`, '{icon}`
     * and `{badge}` with actual values. Both `{icon}` and `{badge}` additionally wrapped with their templates.
     */
    public $staticTemplate = '<a class="nav-link" title="{title}">{icon}{badge}</a>';
    /**
     * @var string template used to render link element with some url to go. Replace tokens `{title}`, '{icon}`, `{url}`
     * and `{badge}` with actual values. Both `{icon}` and `{badge}` additionally wrapped with their templates.
     */
    public $linkTemplate = '<a class="nav-link" href="{url}" title="{title}">{icon}{badge}</a>';
    /**
     * @var string template used to render static element without any url or widget. Replace tokens `{title}`, '{icon}`
     * and `{badge}` with actual values. Both `{icon}` and `{badge}` additionally wrapped with their templates.
     */
    public $dropdownTemplate = '<a class="nav-link" data-toggle="dropdown" href="#" title="{title}">{icon}{badge}</a>{items}';
    /**
     * @var string template used to render item icon, embeds value of $icon through token `{icon}`.
     */
    public string $iconTemplate = '<i class="far {icon}"></i>';
    /**
     * @var string template used to render badge, embeds badge class and name through tokens `{class}` and `{name}`.
     */
    public string $badgeTemplate = '<span class="badge navbar-badge {class}">{badge}</span>';

    public string $template = '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">{items}</div>';

    protected function renderWidget(): string
    {
        if (empty($icon = $this->getCallableValue($this->icon))) return '';
        $badge = $this->getCallableValue($this->badge);
        $style = $this->getCallableValue($this->style);
        $url = $this->getCallableValue($this->url);
        $template = $this->url ? $this->linkTemplate : ($this->items ? $this->dropdownTemplate : $this->staticTemplate);
        return strtr($template, [
            '{url}' => $url ? Url::to($url) : '',
            '{title}' => $this->getCallableValue($this->title),
            '{icon}' => $icon ? strtr($this->iconTemplate, ['{icon}' => $icon]) : '',
            '{badge}' => $badge && $style ? strtr($this->badgeTemplate, ['{badge}' => $badge, '{class}' => $this->style]) : '',
            '{items}' => $this->items ? parent::renderWidget() : '',
        ]);
    }
}