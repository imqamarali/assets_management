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
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<link rel="icon" href="logo.ico" type="image/x-icon"/>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <?= Html::csrfMetaTags() ?>
    <title>Pakistan Profiles</title>
    <?php $this->head() ?>
</head>
<body class="no-skin">
<?php $this->beginBody() ?>
    <?=  $this->render('navbar1'); ?>


    		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

                       
                        <?php //  $this->render('sidebar'); ?>
                        
			<div class="main-content">
				<div class="main-content-inner">
                                    <?= $content ?>
				</div>
			</div><!-- /.main-content -->

                        <?= $this->render('footer'); ?>
                        
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>

		</div><!-- /.main-container -->

    
    
    
<div class="wrap">
    <div class="container">
        
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
$('.date-picker').datepicker({
					format : 'yyyy-m-d',
					autoclose: true,
					todayHighlight: true
				})
</script>