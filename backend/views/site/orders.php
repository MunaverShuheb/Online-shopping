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

$this->title = 'Admin';
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
#sidenav{
    /*position: fixed;*/
    background: #242348;
    height: 100vh;
    padding: 0;
}
.searchbtn{
        height: auto;
        background: none;
        border: none;
    }
html ,body{
    height: 100%;
    overflow: hidden;
}
</style>
<div style="width:100%;height: 100%;position: relative;">
    <div class="col-md-2"  id="sidenav">
        <h2 class="text-center" style="color: #fff;">
            net<span style="color: #FF5D00;">X</span>fits</h2>
            <ul style=" padding: 0; margin-left: 0;">
            <li > <?=
        Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<span class="glyphicon glyphicon-log-out" style="color: #fff;">'.' Logout',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm() ?></span>
            </li>
            <li><?=
        Html::beginForm(['/site/index'], 'post')
            . Html::submitButton(
                '<span class="glyphicon glyphicon-briefcase" style="color: #fff;">'.' Products',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm() ?></span>
            </li>
            <li style="border-left: 2px solid #FF5D00; background: #3C3B54;"><?=
                    Html::beginForm(['/site/orders'], 'post')
                        . Html::submitButton(
                            '<span class="glyphicon glyphicon-check" style="color: #fff;">'.' Orders',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm() ?></span>
            </li>
            <li><?=
                    Html::beginForm(['/site/customers'], 'post')
                        . Html::submitButton(
                            '<span class="glyphicon glyphicon-user" style="color: #fff;">'.' Customers',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm() ?></span>
            </li>
           </ul>
    </div>


<div class="col-md-10" style="padding: 2%;">

    <div class="col-md-12 text-right" style="margin: 1%;"><br>
        <?=
        Html::beginForm(['/site/orders'], 'post') ?>
<div class="col-md-9"> </div>
  <div class="input-group col-md-3">  
        <?= Html::textInput('inputTxt','', ['class' => 'form-control inputTxt','placeholder' => "Search by Product name"]) ?>
        <span class="input-group-addon">
        <?= Html::submitButton(
                '<i  title=" Search." class="glyphicon glyphicon-search"></i></span>',
                ['class' => 'searchbtn','name' => 'search']
            ) ?>
        
        <?= Html::endForm() ?>
        <?= Html::submitButton(
                '<i title="Reset Search." class="glyphicon glyphicon-refresh"></i></span>',
                ['class' => 'searchbtn','name' => 'search']
            ) ?>
            
        <?= Html::endForm() ?>
            </div>

                
            </div>

    <?= GridView::widget([
      'dataProvider' => $dataprovider,
      'tableOptions' => ['class' => 'table table-striped table-bordered'],
      'id' => 'myTable',
      // 'filterModel' => $searchModel,
      // 'filterModel' => $searchModel,
      // 'filterModel' => $searchModel,
      'columns' => [
                   ['class' => 'yii\grid\SerialColumn'],'p_id','usr_id','product_name','details','Amount','ordered_date'
           ],
   ]);
?>
</div>
</div>