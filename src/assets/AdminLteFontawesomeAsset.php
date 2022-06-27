<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteFontawesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/fontawesome-free';
    public $css = [
        'css/all.min.css',
    ];
    public $js = [];
    public $depends = [];
}
