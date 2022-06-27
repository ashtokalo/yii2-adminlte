<?php
/** @var \yii\web\View $this */
$module = \ashtokalo\yii2\adminlte\Module::$instance;
\ashtokalo\yii2\adminlte\assets\AdminLteAsset::register($this);
\ashtokalo\yii2\adminlte\assets\AdminLteFontawesomeAsset::register($this);
\ashtokalo\yii2\adminlte\assets\AdminLteOverlayScrollbarsAsset::register($this);
$this->beginPage();
?><!DOCTYPE html><html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->params['head_title'] ?? (Yii::$app->name . ' | ' . ($this->params['head_title_text'] ?? $this->title)) ?></title>
  <!-- Google Font: Source Sans Pro -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"-->
  <?php $this->head() ?>
</head>
<body class="<?= $module->getBodyClasses('hold-transition', $this->params['body_class'] ?? []) ?>">
<?php $this->beginBody() ?>
<div class="wrapper">
  <?= $module->renderNavbar() ?>
  <?= $module->renderSidebar() ?>
  <div class="content-wrapper">
    <section class="content-header<?= $module->wideLayout === false && $module->boxed === false ? ' container' : '' ?>">
      <?php if ($this->title): ?>
      <div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1><?= $this->title ?></h1></div><?=
          isset($this->params['breadcrumbs']) && $this->params['breadcrumbs']
          ? '<div class="col-sm-6"><ol class="breadcrumb float-sm-right">' . \yii\widgets\Breadcrumbs::widget([
                'itemTemplate' => '<li class="breadcrumb-item">{link}</i></li>',
                'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</i></li>',
                'links' => $this->params['breadcrumbs'],
            ]) . '</ol></div>'
          : ''
      ?></div></div>
      <?php endif ?>
    </section>
      <section class="content<?= $module->wideLayout === false && $module->boxed === false ? ' container' : '' ?>">
          <?php if (isset($this->blocks['sidebar']) && !empty($this->blocks['sidebar'])): ?>
          <div class="row">
              <div class="col-lg-9 col-lg-pull-3">
                  <?= $content ?>
              </div>
              <div class="col-lg-3 col-lg-push-9">
                  <?= $this->blocks['sidebar'] ?? '' ?>
              </div>
          </div>
          <?php else: ?>
          <?= $content ?>
          <?php endif ?>
    </section>
  </div>
  <?= ($admin_lte_footer = $module->renderFooter()) ? '<footer class="main-footer">' . $admin_lte_footer . '</footer>' : '' ?>
  <?= isset($this->params['control_sidebar']) && $this->params['control_sidebar'] ? $this->params['control_sidebar'] : '' ?>
</div>
<?= $module->renderAlerts(); ?>
<?php $this->endBody() ?>
</body></html>
<?php $this->endPage() ?>