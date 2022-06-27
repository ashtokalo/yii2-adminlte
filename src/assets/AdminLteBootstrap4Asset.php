<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteBootstrap4Asset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/bootstrap';
    public $css = [];
    public $js = [
        'js/bootstrap.bundle.min.js',
    ];
    public $depends = [
        JqueryAsset::class,
        //AdminLteJqueryAsset::class,
    ];
}
