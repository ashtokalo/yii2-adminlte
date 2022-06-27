<?php

namespace ashtokalo\yii2\adminlte\widgets;

use yii\base\Widget;
use yii\helpers\Url;

class MenuItem extends Menu
{
    /**
     * @var string|callable menu item label. When using a closure, its signature should be `function (MenuItem $item)`
     * and returned value must be string.
     */
    public $label;
    /**
     * @var string|callable class name of icon from Font Awesome set, e.g. `fa-search`. When using a closure, its
     * signature should be `function (MenuItem $item)` and returned value must be string or null if no icon required.
     */
    public $icon;
    /**
     * @var string|callable specifies the URL of the menu item. It will be processed by [[Url::to]]. When this is set,
     * the actual menu item content will be generated using [[linkTemplate]], otherwise [[labelTemplate]] will be used.
     */
    public $url;
    /**
     * @var array|callable optional, if string, than badge with style `badge-info` will be rendered; if array, it must
     * include following items to be rendered:
     * - `label` - badge text,
     * - `style` - optional, CSS class names to decorate badge, badge-info by default,
     * - `title` - optional, popup text to explain badge value, empty string by default
     * When using a closure, it's signature should be `function (MenuItem $item):array`. The result of closure must be
     * an array with items `label`, `style` and `title`.
     *
     * There are few badge classes already available:
     * - `badge-primary` - changes color,
     * - `badge-secondary` - changes color,
     * - `badge-info` - changes color,
     * - `badge-danger` - changes color,
     * - `badge-warning` - changes color,
     * - `badge-light` - changes color,
     * - `badge-dark` - changes color,
     * - `badge-success` - changes color,
     * - `badge-pill` - changes shape, could be applied with any other;
     */
    public $badge;
    /**
     * @var bool|array|string|callable optional, if set to TRUE or FALSE then item will be rendered as active or not.
     * When using a closure, its signature should be `function (MenuItem $item):bool`. The result of closure must be
     * TRUE or FALSE. When using an array, it's list of routes in addition to [[url]]. When using a string, it must be
     * regular expression to compare with `Yii::$app->controller->route`. Otherwise, the method [[isActive]] will be used.
     */
    public $active;
    /**
     * @var bool|callable optional, if set to TRUE or FALSE then sub items will be rendered as expanded or collapsed.
     * When using a closure, its signature should be `function (MenuItem $item):bool`. The result of closure must be
     * TRUE or FALSE. By default, it uses method [[getActiveSubItems]] to find if the item must be expanded or not.
     */
    public $expanded;
    /**
     * @var string template used to render item icon, embeds value of $icon through token `{icon}`.
     */
    public string $iconTemplate = '<i class="nav-icon fas {icon}"></i>';
    /**
     * @var string template used to render badge, embeds badge class and name through tokens `{class}` and `{name}`.
     */
    public string $badgeTemplate = '<span class="right badge {class}" title="{title}">{badge}</span>';
    /**
     * @var string template used to render menu item with action url, embeds data through tokens `{url}`, `{label}`,
     * `{icon}`, `{subicon}`, `{badge}` and `{subitems}`.
     */
    public string $linkTemplate = '<a href="{url}" class="nav-link">{icon}<p>{label}{badge}</p></a>{subitems}';
    /**
     * @var string template used to render active menu item with action url, embeds data through tokens `{url}`, `{label}`,
     * `{icon}`, `{subicon}`, `{badge}` and `{subitems}`.
     */
    public string $activeTemplate = '<a href="{url}" class="nav-link active">{icon}<p>{label}{badge}</p></a>{subitems}';
    /**
     * @var string template used to render menu item with action url, embeds data through tokens `{url}`, `{label}`,
     * `{icon}`, `{subicon}`, `{badge}` and `{subitems}`.
     */
    public string $dropdownLinkTemplate = '<a href="{url}" class="nav-link">{icon}<p>{label}<i class="right fas fa-angle-left"></i>{badge}</p></a>{subitems}';
    /**
     * @var string template used to render active menu item with action url, embeds data through tokens `{url}`, `{label}`,
     * `{icon}`, `{subicon}`, `{badge}` and `{subitems}`.
     */
    public string $dropdownActiveTemplate = '<a href="{url}" class="nav-link active">{icon}<p>{label}<i class="right fas fa-angle-left"></i>{badge}</p></a>{subitems}';
    /**
     * @var string template used to render menu item without action url, e.g. section name. Embeds data through tokens
     * `{label}`, `{icon}`, `{badge}`.
     */
    public string $labelTemplate = '{icon}{label}{badge}';

    // following templates used to wrap sub items
    public string $template = '<ul class="nav nav-treeview" style="display: none">{items}</ul>';
    public string $expandedResultTemplate = '<ul class="nav nav-treeview">{items}</ul>';
    public string $dropdownItemTemplate = '<li class="nav">{item}</li>';

    public $defaultItemConfig = MenuItem::class;

    protected function renderWidget(): string
    {
        $template = $this->template;
        $this->template = '{items}';
        $subItems = count($this) ? parent::renderWidget() : '';
        $itemTemplate = $this->labelTemplate;
        if ($this->url || $this->hasVisibleSubItems()) {
            if ($this->hasVisibleSubItems()) {
                $itemTemplate = $this->isActive() ? $this->dropdownActiveTemplate : $this->dropdownLinkTemplate;
            } else {
                $itemTemplate = $this->isActive() ? $this->activeTemplate : $this->linkTemplate;
            }
        }
        $result = strtr($itemTemplate, [
            '{url}' => $this->url ? Url::to($this->getCallableValue($this->url)) : '/',
            '{label}' => $this->getCallableValue($this->label),
            '{icon}' => $this->icon ? strtr($this->iconTemplate, ['{icon}' => $this->getCallableValue($this->icon)]) : '',
            '{badge}' => $this->renderBadge(),
            '{subitems}' => $subItems
                ? strtr($this->isExpanded() ? $this->expandedResultTemplate : $template, ['{items}' => $subItems])
                : '',
        ]);
        $this->template = $template;
        return $result;
    }

    protected function renderBadge(): string
    {
        if (!empty($badge = $this->getCallableValue($this->badge) ?: [])) {
            $badge = strtr($this->badgeTemplate, [
                '{badge}' => is_array($badge) ? $badge['label'] ?? '!' : $badge,
                '{class}' => is_array($badge) ? $badge['style'] ?? 'badge-info' : 'badge-info',
                '{title}' => is_array($badge) ? $badge['title'] ?? '' : '',
            ]);
        }
        return $badge ?: '';
    }

    public function isSameRoutes($routes, $baseRoute = '')
    {
        if (empty($baseRoute)) $baseRoute = \Yii::$app->controller->route;
        foreach ((array) $routes as $route) {
            if ($route && is_array($route) && isset($route[0])) {
                $route = \Yii::getAlias($route[0]);
                if (strncmp($route, '/', 1) !== 0 && \Yii::$app->controller) {
                    $route = \Yii::$app->controller->module->getUniqueId() . '/' . $route;
                }
                if (ltrim($route, '/') === $baseRoute) return true;
            }
        }
        return false;
    }

    public function isActive(): bool
    {
        if (!$this->isVisible()) return false;
        if ((is_bool($this->active) || is_callable($this->active))) return !!$this->getCallableValue($this->active);
        if (is_string($this->active) && preg_match($this->active, \Yii::$app->controller->route)) return true;
        if ($this->isSameRoutes($this->url)) return true;
        if (is_array($this->active) && $this->isSameRoutes($this->active)) return true;
        return false;
    }

    public function isExpanded()
    {
        if ((is_bool($this->expanded) || is_callable($this->expanded))) return !!$this->getCallableValue($this->expanded);
        return $this->getActiveSubItem() !== null;
    }

    /**
     * Returns active subitem or NULL if no active sub items found.
     *
     * @return MenuItem|null
     */
    protected function getActiveSubItem(): ?MenuItem
    {
        foreach ($this as $name => $item) {
            if ($item instanceof MenuItem && $item->isActive()) return $item;
        }
        return null;
    }

    public function hasVisibleSubItems(): bool
    {
        foreach ($this as $name => $item) {
            if ($item instanceof MenuItem && $item->isVisible()) return true;
        }
        return false;
    }

    public function hasActiveSubItems(): bool
    {
        return is_objcet($this->getActiveSubItem());
    }
}