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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
    background: #f1f3f6;
    /*overflow: hidden;*/
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

<div class="col-md-12" style="align-items: center; margin-top: 7%;">
        <?php
        for ($i=0; $i<count($result); $i++) { 
        $path = $result[$i]['path']; 
        ?>
        <div class="col-md-2" style="display: inline-block; text-align: center;  border-radius: 10%;background: #ffff;margin: 10px; box-shadow: 3px 5px #88888854;">
                <br><img style="height: 180px; max-width:90%;" src="<?= Yii::$app->request->baseUrl.'/../../backend/web/'.$result[$i]['path'] ?>" name= 'viewproduct' value = $result[$i]['p_id']><br><br>
                <h5><?=$result[$i]['p_name']?></h5>
            <div style="display: inline;">
            <h6 style="display: inline;">&#8377;</h6>   
            <h6 style="display: inline;"><?=$result[$i]['price']?></h6>
            </div>
            <div >
              <?php $form=ActiveForm::begin(['method' => 'post' , 'action' => ['site/view']]); ?>
                        <?= Html::submitButton(
                            ''.'Buy',
                            ['class' => 'btn btn-link logout','id' => 'bt', 'name' => 'viewproduct', 'value' => $result[$i]["p_id"]]
                        ) ?>
                        <?php ActiveForm::end(); ?>
             </div>
        </div>
        <?php } ?>
   
</div>



