<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;


use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/simplebar/simplebar.min.js"></script>
    <script src="assets/js/config.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="vendors/choices/choices.min.css" rel="stylesheet">
    <link href="vendors/dhtmlx-gantt/dhtmlxgantt.css" rel="stylesheet">
    <link href="vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <style>
        .navbar-top {
            background: #60c6ff;
        }

        .content {
            background-color: #fff;
        }

        .bg-soft {

            background-color: #fff !important;
        }
    </style>
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>

    <style>
        #toastBox {
            position: absolute;
            top: 30px;
            right: 30px;
            display: flex;
            align-items: flex-end;
            flex-direction: column;
            overflow: hidden;
            padding: 20px;
        }

        .toast {
            font-size: smaller;
            width: 350px;
            height: 47px;
            background: #fff;
            font-weight: 500;
            margin: 4px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            position: relative;
        }

        .toast i {
            margin: 0 20px;
            font-size: 30px;
            color: green;
        }

        .toast.error i {
            color: red;
        }

        .toast.invalid i {
            color: orange;
        }

        .toast::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 5px;
            background: green;
            animation: anim 3s linear forwards;
        }

        @keyframes anim {
            100% {
                width: 0;
            }
        }

        .toast.error::after {
            background: red;
        }

        .toast.invalid::after {
            background: orange;
        }

        .btn-new {
            color: white;
            margin: 10px;
            border-width: 3px;
            background-color: #727272;
            border-color: #525252;
            transition: 0.3s;
            background: #525252;
            color: white;
            padding: 5px;
            background-color: #727272;
            transition: .3s;
            background: #525252;
            background-color: #525252 !important;
            border-color: #525252;
        }
    </style>
</head>


<body>
    <?php $this->beginBody() ?>
    <main class="main" id="top">
        <div class="container">

            <?php
            $form = ActiveForm::begin([
                //'id' => 'login-form',
                //'options' => ['class' => 'form-horizontal'],
                //'fieldConfig' => [
                //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                //'labelOptions' => ['class' => 'col-lg-1 control-label'],
                //],
            ]);
            ?>

            <input type="hidden" name="actionID" />
            <input type="hidden" name="hdnUserTimeZoneOffset" id="hdnUserTimeZoneOffset" value="0" />
            <input name="installation" id="installation" type="hidden" value="" /><input type="hidden"
                name="_csrf_token" value="d4f55fc0a442e099a11bf393b8a6945d" id="csrf_token" />
            <div class="row flex-center min-vh-100" style="margin-top: -100px">
                <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
                    <div class="text-center mb-7">
                        <h3 class="text-1000">Sign In</h3>
                        <p class="text-700">Get access to your account</p>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="email">Email address</label>
                        <div class="form-icon-container">
                            <?= $form->field($model, 'email')->textInput(['class' => "form-control form-icon-input", 'id' => "txtUsername"])->label(false) ?>

                            <span class="fas fa-user text-900 fs--1 form-icon"></span>

                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="password">Password</label>
                        <div class="form-icon-container">
                            <?= $form->field($model, 'password')->passwordInput(['class' => "form-control form-icon-input", 'id' => "txtPassword", 'autocomplete' => "off"])->label(false) ?>
                            <span class="fas fa-key text-900 fs--1 form-icon"></span>
                        </div>
                    </div>
                    <div class="row flex-between-center mb-7">
                        <div class="col-auto">
                            <div class="form-check mb-0">
                                <input class="form-check-input" id="basic-checkbox" type="checkbox" checked="checked" />
                                <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                            </div>
                        </div>
                        <div class="col-auto"><a class="fs--1 fw-semi-bold" href=""></a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/popper/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/anchorjs/anchor.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="vendors/lodash/lodash.min.js"></script>
    <script src="vendors/feather-icons/feather.min.js"></script>
    <script src="vendors/dayjs/dayjs.min.js"></script>
    <script src="vendors/choices/choices.min.js"></script>
    <script src="vendors/echarts/echarts.min.js"></script>
    <script src="vendors/dhtmlx-gantt/dhtmlxgantt.js"></script>
    <script src="assets/js/phoenix.js"></script>
    <script src="assets/js/maint.js"></script>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>