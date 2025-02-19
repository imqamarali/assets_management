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
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Phoenix</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
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
        top: 80px;
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
        background: red;
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
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <?= $this->render('sidebar'); ?>

        <div class="content">


            <?= $content ?>


            <div id="toastBox"></div>
        </div>

        <?= $this->render('footer'); ?>

        </div>


        </div>
    </main>

    <script>
    let toastBox = document.getElementById('toastBox');

    function showToast(message) {

        let toast = document.createElement('div');
        toast.classList.add('toast');
        toast.innerHTML = '<i class="fa fa-info"></i> ' + message;
        toastBox.appendChild(toast);
        if (message.includes('error')) {
            toast.classList.add('error');
        }
        if (message.includes('Invalid')) {
            toast.classList.add('invalid');
        }
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
    showToast("error : Hello");
    </script>
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


    <script>
    var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
    var navbarTop = document.querySelector('.navbar-top');
    if (navbarTopStyle === 'darker') {
        navbarTop.classList.add('navbar-darker');
    }

    var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
    var navbarVertical = document.querySelector('.navbar-vertical');
    if (navbarVertical && navbarVerticalStyle === 'darker') {
        navbarVertical.classList.add('navbar-darker');
    }
    </script>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>