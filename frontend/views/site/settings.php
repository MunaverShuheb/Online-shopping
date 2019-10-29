<?php

/* @var $this yii\web\View */
use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\grid\GridView;
use yii\model\Update;
use frontend\controllers\SiteController;
use yii\bootstrap\ActiveForm;

$this->title = 'User';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>./css/indexpage.css">

<style type="text/css">

html ,body{
    height: 100%;
    background: #f1f3f6;
    overflow: hidden;
}
</style>

    <?php
            NavBar::begin([
                'brandLabel' => 'netfits' ,
                // 'brandUrl' => Yii::$app->homeUrl,
                'brandOptions' =>[
                    'style' => 'font-family: palatino;font-size:50px;color:#fff;'
                ],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                    'class' => 'navbar-default navbar-fixed-top',
                    'style'=> 'background:#242348; height:10%;display:flex; align-items:center;',
                ],
            ]);?> 
            <?php 
            $menuItems = [ 
                ['label' => 'Home', 'url' => ['/site/index'],'linkOptions' => ['style'=>'color:#fff;']],
                ['label' => 'Cart', 'url' => ['/site/orders'],'linkOptions' => ['style'=>'color:#fff;']],
                ['label' => 'Settings', 'url' => ['/site/settings'],'linkOptions' => ['style'=>'color:#fff;background:#4a494d;height:10%;border-radius:30%;']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/user/register'],'linkOptions' => ['style'=>'color:#fff;']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/user/login'],'linkOptions' => ['style'=>'color:#fff;']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post','style'=>'color:#fff;'],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right',],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top: 6%; height: 590px; background: #fff;">
           <h1>Update Profile</h1>
        
        
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="col-md-12">
        <div class="col-md-3"></div>
    <div class="alert alert-success alert-dismissable col-md-6" style="height: 70px;text-align: center;">
      <?=
                    Html::beginForm(['/site/settings'], 'post')
                        . Html::submitButton(
                            '&times;',
                            ['class' => 'close', 'name' => 'close']
                        )
                        . Html::endForm() ?>
         
         <h4><i class="icon fa fa-check"></i>Saved!</h4>
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
    </div>
<?php endif; ?>

 <?php if (Yii::$app->session->hasFlash('danger')): ?>
    <div class="col-md-12">
        <div class="col-md-3"></div>
    <div class="alert alert-danger alert-dismissable col-md-6" style="height: 70px; text-align: center;">
      <?=
                    Html::beginForm(['/site/settings'], 'post')
                        . Html::submitButton(
                            '&times;',
                            ['class' => 'close', 'name' => 'close']
                        )
                        . Html::endForm() ?>
         
         <h4><i class="icon fa fa-warning"></i>Error!</h4>
         <?= Yii::$app->session->getFlash('danger') ?>
    </div>
    </div>
<?php endif; ?>


           <hr style="font-size: 2px;">
           <div class="col-md-2"></div>
           <div class="col-md-8" style="padding-left: 2%;">

    <?php $form=ActiveForm::begin(); ?>
<br>
<?= $form->field($model, 'oldpass')->textInput()->input('password',['placeholder' => "Enter Old Password",'style'=>'type:password;'])->label(false) ?>

<?php echo $form->field($model, 'First_name')->textInput()->input('First_name', ['placeholder' => "Enter New First Name"])->label(false); ?>

<?php echo $form->field($model, 'Last_name')->textInput()->input('Last_name', ['placeholder' => "Enter New Last Name"])->label(false); ?>

<?= $form->field($model, 'password')->textInput()->input('password',['placeholder' => "Enter New Password"])->label(false) ?>

<?php echo $form->field($model, 'username')->textInput()->input('username', ['placeholder' => "Enter New Username"])->label(false); ?>

<?php echo $form->field($model, 'phone')->textInput()->input('phone', ['placeholder' => "Enter New Phone Number"])->label(false); ?>

<?php echo $form->field($model, 'Email')->textInput()->input('Email', ['placeholder' => "Enter New Email ID"])->label(false); ?><br>

<center>
    <?= Html::submitButton('New Account', ['class' => 'btn btn-lg','style' => 'background-color:#242348; color:#fff;' , 'id' => "submitBtn"]) ?>
</center>

 <?php ActiveForm::end(); ?>
 
         </div>