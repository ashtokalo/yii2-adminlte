<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    public $css = [
        'css/adminlte.min.css',
    ];
    public $depends = [
        JqueryAsset::class,
        AdminLteFontawesomeAsset::class,
        AdminLteBootstrap4Asset::class,
        PaginationAssets::class,
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $js = [
        'js/adminlte.min.js',
    ];
}
