<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteJqueryAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/jquery';
    public $css = [];
    public $js = [
        'jquery.min.js',
    ];
    public $depends = [];
}
