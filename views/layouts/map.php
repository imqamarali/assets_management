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
    <title>HSMS</title>
    <?php $this->head() ?>
</head>
<body class="no-skin">
<?php $this->beginBody() ?>
    
<?= $this->render('navbarmap'); ?>

<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>

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

<!-- <div class="wrap">
	<div class="container">
		
	</div>
</div> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
	$('.date-picker').datepicker({
		format : 'dd-mm-yyyy',
		autoclose: true,
		todayHighlight: true
	})
	$('.date-picker1').datepicker({
		format : 'yyyy-mm-dd',
		autoclose: true,
		todayHighlight: true
	})
</script>
<script type="text/javascript">
	jQuery(function($) {
		var $validation = false;
		$('#fuelux-wizard-container')
		.ace_wizard({
			//step: 2 //optional argument. wizard will jump to step "2" at first
			//buttons: '.wizard-actions:eq(0)'
		})
		.on('actionclicked.fu.wizard' , function(e, info){
			if(info.step == 1 && $validation) {
				if(!$('#validation-form').valid()) e.preventDefault();
			}
		})
		.on('finished.fu.wizard', function(e) {
			bootbox.dialog({
				message: "Thank you! Your information was successfully saved!", 
				buttons: {
					"success" : {
						"label" : "OK",
						"className" : "btn-sm btn-primary"
					}
				}
			});
		}).on('stepclick.fu.wizard', function(e){
			//e.preventDefault();//this will prevent clicking and selecting steps
		});
		//hide or show the other form which requires validation
		//this is for demo only, you usullay want just one form in your application
		$('#skip-validation').removeAttr('checked').on('click', function(){
			$validation = this.checked;
			if(this.checked) {
				$('#sample-form').hide();
				$('#validation-form').removeClass('hide');
			}
			else {
				$('#validation-form').addClass('hide');
				$('#sample-form').show();
			}
		})

		$.mask.definitions['~']='[+-]';
		$('#phone').mask('(999) 999-9999');
	
		jQuery.validator.addMethod("phone", function (value, element) {
			return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
		}, "Enter a valid phone number.");
	
		$('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				email: {
					required: true,
					email:true
				},
				password: {
					required: true,
					minlength: 5
				},
				password2: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				name: {
					required: true
				},
				phone: {
					required: true,
					phone: 'required'
				},
				url: {
					required: true,
					url: true
				},
				comment: {
					required: true
				},
				state: {
					required: true
				},
				platform: {
					required: true
				},
				subscription: {
					required: true
				},
				gender: {
					required: true,
				},
				agree: {
					required: true,
				}
			},
	
			messages: {
				email: {
					required: "Please provide a valid email.",
					email: "Please provide a valid email."
				},
				password: {
					required: "Please specify a password.",
					minlength: "Please specify a secure password."
				},
				state: "Please choose state",
				subscription: "Please choose at least one option",
				gender: "Please choose gender",
				agree: "Please accept our policy"
			},
	
	
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
	
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
				$(e).remove();
			},
	
			errorPlacement: function (error, element) {
				if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
					var controls = element.closest('div[class*="col-"]');
					if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
					else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
				}
				else if(element.is('.select2')) {
					error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
				}
				else if(element.is('.chosen-select')) {
					error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
				}
				else error.insertAfter(element.parent());
			},
	
			submitHandler: function (form) {
			},
			invalidHandler: function (form) {
			}
		});
	
		
		
		
		$('#modal-wizard-container').ace_wizard();
		$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
		$(document).one('ajaxloadstart.page', function(e) {
			//in ajax mode, remove remaining elements before leaving page
			$('[class*=select2]').remove();
		});
	})
</script>