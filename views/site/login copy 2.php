<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;


use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
body {
    background-color: #FFFFFF;
    height: 700px;
    line-height: 0.5
}

img {
    border: none;
}

#btnLogin {
    padding: 0;
}

input:not([type="image"]) {
    background-color: transparent;
    border: none;
}

input:focus,
select:focus,
textarea:focus {
    background-color: transparent;
    border: none;
}

.textInputContainer {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #666666;
}

#divLogin {
    background: transparent url(images/login.png) no-repeat center top;
    height: 520px;
    width: 100%;
    border-style: hidden;
    margin: auto;
    padding-left: 10px;
}

#divUsername {
    padding-top: 212px;
    padding-left: 50%;
}

#divPassword {
    /*padding-top: 35px;*/
    padding-left: 50%;
}

#txtUsername {
    margin-top: 4px;
    height: 24px;
    width: 240px;
    border: 0px;
}

#txtPassword {
    margin-top: 28px;
    height: 24px;
    width: 240px;
    border: 0px;
}

#txtUsername,
#txtPassword {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #666666;
    vertical-align: middle;
    padding-top: 0;
}

#divLoginHelpLink {
    width: 270px;
    background-color: transparent;
    height: 20px;
    margin-top: 12px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 50%;
}

#divLoginButton {
    padding-top: 2px;
    padding-left: 49.3%;
    float: left;
    width: 350px;
}

#btnLogin {
    background-color: #4c97f4;
    cursor: pointer;
    width: 94px;
    height: 26px;
    border-radius: 24px;
    border: none;
    color: #FFFFFF;
    opacity: 0.7;
    font-weight: bold;
    font-size: 13px;
}

#divLink {
    padding-left: 230px;
    padding-top: 105px;
    float: left;
}

#divLogo {
    padding-left: 30%;
    padding-top: 70px;
}

#spanMessage {
    background: transparent url(images/mark.png) no-repeat;
    padding-left: 18px;
    padding-top: 0px;
    color: #DD7700;
    font-weight: bold;
}

#logInPanelHeading {
    position: absolute;
    padding-top: 164px;
    padding-left: 49.5%;
    font-family: sans-serif;
    font-size: 15px;
    color: #544B3C;
    font-weight: bold;
}

.form-hint {
    color: #878787;
    padding: 4px 8px;
    position: relative;
    left: -254px;
}

.loginSuccessMessage {
    font-size: 15px;
    font-weight: bold;
    padding-left: 55px;
    width: 100%;
}
</style>
<!-- <h1 style="border-bottom: thin solid rgb(180, 188, 207);"><?php // Html::encode($this->title) 
                                                                ?></h1> -->

<div id="divLogin">
    <div id="divLogo">

    </div>
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
    <input name="installation" id="installation" type="hidden" value="" /><input type="hidden" name="_csrf_token"
        value="d4f55fc0a442e099a11bf393b8a6945d" id="csrf_token" />


    <div id="logInPanelHeading">LOGIN Panel</div>

    <div id="divUsername" class="textInputContainer">

        <?= $form->field($model, 'email')->textInput(['id' => "txtUsername"])->label(false) ?>

    </div> <!--   <span class="form-hint" >Username</span>  -->

    <div id="divPassword" class="textInputContainer">


        <?= $form->field($model, 'password')->passwordInput(['id' => "txtPassword", 'autocomplete' => "off"])->label(false) ?>
        <!--  <span class="form-hint" >Password</span> -->
    </div>
    <div id="divLoginHelpLink"></div>
    <div id="divLoginButton">
        <!--    <input type="submit" name="Submit" class="button" id="btnLogin" value="LOGIN" /> -->
        <?= Html::submitButton('Login', ['class' => 'button', 'id' => "btnLogin", 'name' => 'login-button']) ?>
    </div>



    <!-- <div class="form-row">
        <div class="col-xs-12">
<?php //$form->field($model, 'username') 
?>
        </div>
    </div>

    <div class="form-row"><?php // $form->field($model, 'password')->passwordInput() 
                            ?>
        <div class="col-xs-12">

        </div>
    </div>

    <div class="form-row">
        <div class="col-xs-12">
            <br/>
            <div class="form-group pull-right">
<?php // Html::submitButton('Login', ['class' => 'btn btn-purple no-border btn-round', 'name' => 'login-button']) 
?>
            </div>
        </div>
    </div> -->





    <?php ActiveForm::end(); ?>

</div>