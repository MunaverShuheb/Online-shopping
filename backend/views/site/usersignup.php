<?php

/* @var $this yii\web\View */
use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\grid\GridView;
use yii\model\Update;
use backend\controllers\SiteController;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin Signup';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/css/indexpage.css">

<style type="text/css">
.bttn{
  background: none;
  border: none; 
}
body{
    overflow:hidden;
    width: 100%;
    background:rgba(244,244,244,0.9);
}
.close{
    color: #FF5D00 ! important;
    opacity: 0.8 ! important;
}
form input, #dropDown {
    border-right: none ! important;
    border-left: none ! important;
    border-top: none ! important;
    background: none ! important;
    box-shadow: none ! important;
    border-radius: unset ! important;
    /*border: 1px solid black ! important;*/
    /*border : 0px 0px 1px 0px;*/
}
#userLoginsidediv{
    height: 100vh;
    width: 50%; 
    background: #242348;
    margin-top: 0;
    background-size: cover;
    background-repeat: no-repeat; 
    background-position: center;
}
</style>
    <div class="col-md-6" id='userLoginsidediv'>
      <div style="margin-top: 23%;">
        <h1 align="center" style='color: #fff;'>O n l i n e <span style="color: #FF5D00;">S</span> h o p p i n g</h1>
    <!-- <p align="center" style='color: gray;'>please complete to create account</p> -->
    <center><br><br><br><br><br>
    <img style="width: 40%;height: 40%;" src="https://www.logoup.com/assets/templates/logoup_working_theme-html5/images/shopping-cart.svg">
    </center> 
    </div> 
   </div>
<div class="site-login col-md-6" style="padding: 5%;">
  <br><br>
    <h1 align="center">net<span style="color: #FF5D00;">X</span>fits</h1>
    <p align="center" style='color: gray;'>please complete to create account</p><br><br>
    <?php $form=ActiveForm::begin(); ?>
    <div style="width: 100%;">
          <div class="row">

   <div class="col-md-6">
     <?php echo $form->field($model, 'First_name')->textInput()->input('First_name', ['placeholder' => "First name"])->label(false); ?>
   </div>

   <div class="col-md-6">

      <?php echo $form->field($model, 'Last_name')->textInput()->input('Last_name', ['placeholder' => "Last name"])->label(false); ?>

   </div>
</div><br>

     <?php echo $form->field($model, 'username')->textInput()->input('username', ['placeholder' => "User Name"])->label(false); ?><br>

<div style="position: relative;">
     <?php echo $form->field($model, 'password')->textInput()->input('password',['placeholder' => "Password",'id' =>"myInput"],)->label(false); ?>
     <span id="pass-status" class="fa fa-eye" style="position: absolute; top: 14px; right: 6px;  " aria-hidden="true" onclick="myFunction()"></span>
</div><br>

    <?php echo $form->field($model, 'phone')->textInput()->input('phone', ['placeholder' => "Phone Number"])->label(false); ?>
    <br>

    <?php echo $form->field($model, 'Email')->textInput()->input('Email', ['placeholder' => "Email"])->label(false); ?><br>

    <center>
    <div class="form-group" style="">
        <?= Html::submitButton('New Account', ['class' => 'btn btn-lg','style' => 'background-color:#242348; color:#fff;']) ?>
    </div>
    </center>
            <?php ActiveForm::end(); ?>
        </div>


<script type="text/javascript">
  function myFunction() {
  var x = document.getElementById("myInput");
  var passStatus = document.getElementById('pass-status');
  if (x.type === "password") {
    x.type = "text";
    passStatus.className='fa fa-eye-slash';
  } else {
    x.type = "password";
    passStatus.className='fa fa-eye';
  }
}
    </script>
