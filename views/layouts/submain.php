<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php //$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="icon" href="logo.ico" type="image/x-icon"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title>HSMS</title>
<?php //$this->head() ?>
</head><body class="no-skin">
<?php //$this->beginBody() ?>
<div class="main-container ace-save-state" id="main-container"> 
  <div class="main-content">
    <div class="main-content-inner">
      <?= $content ?>
    </div>
  </div>  
  <?php // $this->render('footer'); ?>
   </div>
<div class="wrap">
  <div class="container"> </div>
</div>
<?php //$this->endBody() ?>
</body>
</html>
<?php //$this->endPage() ?>