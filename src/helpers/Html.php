<?php

namespace ashtokalo\yii2\adminlte\helpers;

use yii\helpers\ArrayHelper;

class Html extends \yii\helpers\Html
{
    /**
     * Composes icon HTML for bootstrap Glyphicons.
     * @param string $name icon short name, for example: 'star'
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. There are also a special options:
     *
     * - tag: string, tag to be rendered, by default 'span' is used.
     * - prefix: string, prefix which should be used to compose tag class, by default 'glyphicon glyphicon-' is used.
     *
     * @return string icon HTML.
     * @see http://getbootstrap.com/components/#glyphicons
     */
    public static function icon($name, $options = [])
    {
        $tag = ArrayHelper::remove($options, 'tag', 'span');
        $classPrefix = ArrayHelper::remove($options, 'prefix', 'fa fa-');
        static::addCssClass($options, $classPrefix . $name);
        return static::tag($tag, '', $options);
    }

}