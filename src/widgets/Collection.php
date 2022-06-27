<?php

namespace ashtokalo\yii2\adminlte\widgets;

class Collection extends Widget implements \Iterator, \ArrayAccess, \Countable
{
    /**
     * @var array List of configurations to create widgets.
     * @see Yii::createObject()
     */
    public array $items = [];

    /**
     * @var string|array Name of class or configuration array to be used if `class` property is absent in item configuration array.
     */
    public $defaultItemConfig;

    /**
     * @var string Template to render item result. Token `{item}` will be replaced with rendering result of the item.
     */
    public string $itemTemplate = '{item}';

    /**
     * @var string Template to render final result. Token `{items}` will be replaced with result of rendering all items.
     */
    public string $template = '{items}';

    public function init()
    {
        if (is_callable($this->items)) $this->items = call_user_func($this->items, $this);
        parent::init();
    }

    protected function renderWidget(): string
    {
        $output = [];
        /* @var $widget Widget */
        foreach ($this as $name => $widget) {
            if (!$this->isEnabled($name)) continue;
            $output[$name] = $this->renderItem(static::widget($widget), $name, $widget);
        }
        return $this->wrapResult($output);
    }

    public function disable($name)
    {
        $this->enabledWidgets[$name] = false;
    }

    public function enable($name)
    {
        $this->enabledWidgets[$name] = true;
    }

    public function isEnabled($name): bool
    {
        return $this->enabledWidgets[$name] ?? true;
    }

    private array $enabledWidgets = [];

    protected function getItem($key)
    {
        $item = $this->items[$key] ?? null;
        if ($item && is_callable($item)) $item = call_user_func($item, $key);
        if ($item && (!is_object($item) || !($item instanceof Widget))) {
            $defaultWidget = $this->defaultItemConfig
                ? (is_array($this->defaultItemConfig) ? $this->defaultItemConfig : ['class' => $this->defaultItemConfig])
                : null;
            // extend item configuration with default one if `class` is absent
            if ($defaultWidget && is_array($item) && !isset($item['class']) && !is_callable($item))
            {
                $item = array_merge($item, $defaultWidget);
            }
            $this->items[$key] = $item = \Yii::createObject($item);
        }
        return $item;
    }

    public function current()
    {
        return $this->getItem(key($this->items));
    }

    public function next()
    {
        next($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function valid(): bool
    {
        return key($this->items) !== null;
    }

    public function rewind()
    {
        reset($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->getItem($offset) ?? null;
    }

    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if (array_key_exists($offset, $this->items)) unset($this->items[$offset]);
    }

    public function count()
    {
        return count($this->items);
    }

    protected function renderItem($out, $name, Widget $widget)
    {
        return strtr($this->itemTemplate, ['{item}' => $out]);
    }

    protected function wrapResult(array $output)
    {
        return strtr($this->template, ['{items}' => implode('', array_values($output))]);
    }
}