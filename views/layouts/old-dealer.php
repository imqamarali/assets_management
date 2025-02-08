<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?> 
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

    <?= $this->render('dealer_navbar'); ?>

    		<div class="main-container ace-save-state" id="main-container">
			 
                        
			<div class="main-content">
				<div class="main-content-inner">
                                    <?= $content ?>
				</div>
			</div> 
			<?= $this->render('footer'); ?>
                        

		</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
