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
#bt{
    color: #FF5D00 ! important;
    opacity: 0.8 ! important;
    background: none ! important;
}
html ,body{
    height: 100%;
    overflow: hidden;
    background: #f1f3f6;
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
                ['label' => 'Home', 'url' => ['/site/index'],'linkOptions' => ['style'=>'color:#fff;background:#4a494d;height:10%;border-radius:30%;']],
                ['label' => 'Cart', 'url' => ['/site/orders'],'linkOptions' => ['style'=>'color:#fff;']],
                ['label' => 'Settings', 'url' => ['/site/settings'],'linkOptions' => ['style'=>'color:#fff;']],
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
    <div class="col-md-8" style="background: #fff;margin-top: 10%;box-shadow: 3px 5px #888888;border-radius: 1%;" >       
    <div class="col-md-12">
        <div class="col-md-6" style="height: 380px; text-align: center;">
            <br>
            <img style  = "max-width:100%;
    height:100%;" src="<?= Yii::$app->request->baseUrl.'/../../backend/web/'.$result[0]['path'] ?>">
        </div>
        <div class="col-md-4" style="height: 380px;"><br><br>
            <h4><?=$result[0]['p_name']?></h4><br>
            <p style="height: 150px; overflow: auto; color: gray;"><?=$result[0]['details']?></p>
            <div>
            <h5 style="display: inline;">&#8377;</h5>   
            <h4 style="display: inline;"><?=$result[0]['price']?></h4>
            </div>
            </div>
    </div>
    <div class="col-md-6">
            <?php $form = ActiveForm::begin(['method' => 'post','action' => ['site/index']]); ?>
           <h1> <?= Html::submitButton('Buy',['class'=>'close','id' => 'bt', 'name' => 'buy','title' =>'Decline Request', 'value' => $result[0]['p_id']]); ?></h1>
           <?php ActiveForm::end(); ?><br><br><br>
        </div>
    </div>
