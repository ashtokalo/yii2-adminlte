<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteToastrAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/toastr';
    public $css = [
        'toastr.min.css',
    ];
    public $js = [
        'toastr.min.js',
    ];
    public $depends = [

    ];
}
