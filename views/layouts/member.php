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
<?php 

	$conn=Yii::$app->getDb(); 
				$sqlimg= "SELECT * FROM config";
			    $resultimg = $conn->createCommand($sqlimg)->queryOne();
			    
?>
    <title>HSMS</title>

    <?php $this->head() ?>

</head>

<body class="no-skin">

<?php $this->beginBody() ?>

   <div id="navbar" class="navbar navbar-default ace-save-state">

  <div class="navbar-container ace-save-state" id="navbar-container">





    <div class="navbar-header pull-left"> <a class="navbar-brand "> <small>  <?php echo $resultimg['companyname']; ?></small> </a> </div>    

    <div class="navbar-buttons navbar-header pull-right" role="navigation">

					<ul class="nav ace-nav pull-right">

					



					<li class="light-blue user-profile">

						<a class="user-menu dropdown-toggle" href="#" data-toggle="dropdown">

							<span id="user_info">

								<b>Welcome,</b>Member <?php //echo $_SESSION['user_array']['name']; ?>

							</span>

							<i class="icon-caret-down"></i>

						</a>

						<ul id="user_menu" class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

							<li><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=/memberlogin/logout"><i class="icon-off"></i> Logout</a></li>

						</ul>

					</li>

			  </ul>

				</div>

    <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">

      <ul class="nav navbar-nav">

        <li> <a > eSystem </a> </li>

      </ul>

    </nav>

  </div>

</div>





    		<div class="main-container ace-save-state" id="main-container">

			<script type="text/javascript">

				try{ace.settings.loadState('main-container')}catch(e){}

			</script>



                       

                        <?php $this->render('sidebar1'); ?>

                        

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