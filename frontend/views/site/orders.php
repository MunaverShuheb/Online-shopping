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
    opacity: 1 ! important;
    background: none ! important;
    font-size: 25px;
}
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
                ['label' => 'Cart', 'url' => ['/site/orders'],'linkOptions' => ['style'=>'color:#fff;background:#4a494d;height:10%;border-radius:30%;']],
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


    <div class="col-md-7" style="margin-top:7%;margin-left:5%;background: #fff; height: 500px;">
       <div class="col-md-12">
        <h3>My Cart</h3>
        <hr style="color: solid #999;">
       </div>
       <div class="col-md-12" style="height:400px; overflow: auto;">
           <?php if ($result) { ?>
           <?php for ($i=0; $i <count($result) ; $i++) { ?>
           <div class="col-md-12" style="border-bottom: 1px solid #c5bdbd80; margin-top: 1%;">
           <div class="col-md-12">
           <div class="col-md-5">
                <img style  = "max-width:100%;
                height:100%;" src="<?= Yii::$app->request->baseUrl.'/../../backend/web/'.$result[$i]['path'] ?>">
           </div>
           <div class="col-md-6" style="">
                <h4><?=$result[$i]['product_name']?></h4>
                <p style="height: 150px;overflow: auto;"><?=$result[$i]['details']?></p><br>
                <div>
                <h5 style="display: inline;">&#8377;</h5>   
                <h4 style="display: inline;"><?=$result[$i]['Amount']?></h4>
                </div>
            </div>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-5">
                <?php $form=ActiveForm::begin(['method' => 'post' , 'action' => ['site/orders']]); ?>
                        <?= Html::submitButton(
                            ''.'Cancle Order',
                            ['class' => 'btn btn-link','id' => 'bt', 'name' => 'cancle', 'value' => $result[$i]["p_id"]]
                        ) ?>
                        <?php ActiveForm::end(); ?>
            </div>
            </div>

            <?php } ?>  
        <?php } 
        else { ?>
        <div>
            <p>No Products are thier in your cart</p>
        </div>
        <?php } ?>  
       </div>
    </div>
    
     <?php
    $cost=0;
    for ($j=0; $j<count($result) ; $j++) { 
       $cost = $cost+$result[$j]['Amount'];
     }
      ?>

    <div class="col-md-3" style="margin-top: 7%;margin-left: 5%;background: #fff;">
        <div class="col-md-12">
        <h3>Product Details</h3>
        <hr style="color: solid #999;">
       </div>
       <div style="margin: 5px; margin-left: 10px;">
        <?php if($result) {?>
        <div class="col-md-9">
            <h4>Number of products</h4>
        </div>
        <div class="col-md-3" style="text-align: center;">
            <h4><?=count($result)?></h4>
        </div>
        <br>
        <div class="col-md-9">
            <h4>Total cost of products</h4>
        </div>
        <div class="col-md-3" style="text-align: center;">
            <h4>&#8377;<?=$cost?></h4>
        </div>
        <br>
        <div class="col-md-9">
            <h4>Delivery</h4>
        </div>
        <div class="col-md-3" style="text-align: center;">
            <h4>&#8377;50</h4>
        </div>
        <div class="col-md-12">
        <hr style="color: solid #999;">
        </div>
        <div class="col-md-9">
        <h4>To Pay</h4>
        </div>
        <div class="col-md-3" style="text-align: center;">
        <h4>&#8377;<?=$cost+50?></h4>
        </div>
      <?php }
      else {
        ?>
        <h4>No product in your cart</h4>
        <?php } ?>
       </div>
    </div>


