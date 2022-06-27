<?php
namespace ashtokalo\yii2\adminlte\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteDataTablesButtonsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'datatables-buttons/css/buttons.bootstrap4.min.css',
    ];
    public $js = [
        'datatables-buttons/js/dataTables.buttons.min.js',
        'datatables-buttons/js/buttons.bootstrap4.min.js',
        'datatables-buttons/js/buttons.colVis.min.js',
    ];
    public $depends = [
        AdminLteDataTablesAsset::class,
    ];
}
