<?php

namespace ashtokalo\yii2\adminlte\helpers;

class DataTableHelper
{
    public static function language(string $code = '') {
        if (empty($code)) $code = \Yii::$app->language;
        $basePath = __DIR__ . '/../messages/';
        $relName = '/datatable.php';
        $messages = realpath($basePath . $code . $relName)
            ?: realpath($basePath . strtolower($code) . $relName)
            ?: realpath($basePath . preg_replace('/[^a-z].+$/', $code) . $relName);
        return $messages ? include $messages : null;
    }
}