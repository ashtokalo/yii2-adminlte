<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteDataTablesSelectAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'datatables-select/css/select.bootstrap4.css',
        'datatables-select/css/select.bootstrap4.min.css',
    ];
    public $js = [
        'datatables-select/js/dataTables.select.min.js',
        'datatables-select/js/select.bootstrap4.min.js',
    ];
    public $depends = [
        AdminLteDataTablesAsset::class,
    ];
}
