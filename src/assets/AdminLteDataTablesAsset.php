<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteDataTablesAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'datatables-bs4/css/dataTables.bootstrap4.min.css',
        'datatables-responsive/css/responsive.bootstrap4.min.css',
    ];
    public $js = [
        'datatables/jquery.dataTables.min.js',
        'datatables-bs4/js/dataTables.bootstrap4.min.js',
        'datatables-responsive/js/dataTables.responsive.min.js',
    ];
    public $depends = [
        AdminLteAsset::class,
    ];
}
