<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin Login';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>./css/indexpage.css">
<div class="col-md-6" id='userLoginsidediv'>
          <div style="margin-top: 23%;">
      <h1 align="center" style='color: #fff;'>O n l i n e <span style="color: #FF5D00;">S</span> h o p p i n g</h1>
    <!-- <p align="center" style='color: gray;'>Login</p> -->
    <center><br><br><br><br><br>
    <img style="width: 40%;height: 40%;" src="https://www.logoup.com/assets/templates/logoup_working_theme-html5/images/shopping-cart.svg">
    </center> 
    </div> 
</div>
<div class="site-login col-md-6">
    <h1>net<span style="color: #FF5D00;">X</span>fits</h1>

    <p>Welcome back Please login to your account : </p>

    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'loginform']); ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
<div class="col-md-12" id="rememberMe" style="text-align: left;">
                <?= $form->field($model, 'rememberMe')->checkbox()->label(true) ?> 
                    
<br>
                </div>
<div class="col-md-6">

                </div>
                <div class="form-group col-md-12" id="logForm">
                    <?= Html::submitButton('Login', ['class' => 'login', 'name' => 'login-button']) ?>
                </div>
<p>Are You New Admin?<a href="http://localhost/dashboard/new-project/backend/web/index.php?r=site%2Fusersignup">Create an account</a></p>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<style type="text/css">
form input[type=checkbox]{
/*display: none;*/
border: 2px solid blue;
font-size: 2em;
color: red ! important;

}
form input:checked {
  background-color: #2196F3 ! important;
  color: red ! important;
}

    
#userLoginsidediv{
    width: 50%; 
    background: #242348;
    height: 100vh; 
    margin-top: 0;
    background-size: cover;
    background-repeat: no-repeat; 
    background-position: center;
}
.site-login{
    text-align: center;
    margin-top: 9%; 
}
.site-login h1{
    letter-spacing: 2.9px;
}
.site-login p{
    opacity: 0.5;
}
#loginform input[type=text],#loginform input[type=password]{
    border-top: 2px solid #fff ! important;
    border-left: 0px;
    border-right: 0px;
    border-bottom: 0.5px solid rgba(0,0,0,0.9);
    border-radius: 0px ! important;
    color: #000000;
    -webkit-box-shadow: none;
    box-shadow: none; 

}
#loginform input:focus{
    outline: 0px ! important;
    -webkit-appearance : none;
    box-shadow: none ! important;
}
.login{
    width: 100px;
    background-color: #242348;
    border: none;
    padding: 8px 8px 8px 8px;
    color: #fff;
}
body{
    overflow-y: hidden ! important;
}
@media only screen and (max-width: 800px) {
  body {
    overflow-y: visible ! important;
  }
  #userLoginsidediv{
    height: 50vH;
  }
}
</style>