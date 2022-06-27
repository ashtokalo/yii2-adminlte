<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\base\Exception;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteOverlayScrollbarsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/overlayScrollbars';
    public $css = [
        'css/OverlayScrollbars.min.css',
    ];
    public $js = [
        'js/jquery.overlayScrollbars.min.js',
    ];
    public $depends = [
        //AdminLteJqueryAsset::class,
        JqueryAsset::class,
    ];
}
