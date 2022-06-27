<?php

namespace app\controllers;

use ashtokalo\yii2\adminlte\Module;
use ashtokalo\yii2\adminlte\widgets\SidebarCustom;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex($layout = '')
    {
        $adminlte = Module::$instance;
        switch ($layout) {
            case 'top':
                // todo: add navbar logo widget here, move layout menu from sidebar to navbar
                $adminlte->wideLayout = false;
                $adminlte->miniSidebar = false;
                $adminlte->collapsedSidebar = true;
                break;
            case 'topsidebar':
                // todo: add navbar logo widget here
                $adminlte->wideLayout = false;
                $adminlte->miniSidebar = false;
                $adminlte->collapsedSidebar = true;
                break;
            case 'boxed':
                $adminlte->wideLayout = false;
                $adminlte->boxed = true;
                break;
            case 'fixedsidebar':
                $adminlte->wideLayout = true;
                $adminlte->boxed = false;
                \Yii::$app->sidebar->footer = null;
                break;
            case 'fixedsidebarcustom':
                $adminlte->wideLayout = true;
                $adminlte->boxed = false;
                \Yii::$app->sidebar->footer = SidebarCustom::class;
                break;
        }

        return $this->render('index');
    }
}