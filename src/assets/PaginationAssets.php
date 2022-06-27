<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class PaginationAssets extends AssetBundle
{
    public $sourcePath = __DIR__ . '/css';
    public $css = [
        'pagination.css',
    ];
    public $depends = [
        AdminLteBootstrap4Asset::class,
    ];
    public $js = [
    ];
}
