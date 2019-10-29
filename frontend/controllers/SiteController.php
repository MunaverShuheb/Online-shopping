<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use app\models\UserForm;
use app\models\Usersignup;
use app\models\Products;
use app\models\View;
use app\models\Orders;
use app\models\User;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['usersignup','error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['userForm', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['orders', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['settings', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
                $id=Yii::$app->user->identity->id;
                $connection2 = Yii::$app->getDb();
                $command2 = $connection2->createCommand("
                            SELECT *
                              FROM user
                             WHERE u_id='$id'
                        ");
                $result2 = $command2->queryAll();
                $_SESSION['Uname']=$result2[0]['First_name']." ".$result2[0]['Last_name'];
                $uid = $result2[0]['u_id'];
                $_SESSION['u_id']=$uid;
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
                            SELECT *
                              FROM products
                        ");
                $result = $command->queryAll();
                $amount = $result[0]['price'];

                If (\Yii::$app->request->isPost) {
                if (\Yii::$app->request->post('buy')) {
                  $pid= Yii::$app->request->post('buy');
                    
                    $model = Products::find()
                            ->where(['p_id' => $pid])
                            ->one();

                      $mod = new Orders;
                      $mod->p_id=$pid;
                      $mod->usr_id=$uid;
                      $mod->product_name=$model['p_name'];
                      $mod->details=$model['details'];
                      $mod->path=$model['path'];
                      $mod->Amount=$model['price'];
                      $mod->ordered_date=date('y:m:d h:m:s');
                      $mod->save();
                      }
                if (\Yii::$app->request->post('buy')) {
                  
                }
                }
        return $this->render('index',['result' => $result]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $result=Products::find()->All();
       
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        // public function actionUsersignup()

        return $this->goHome();
    }

    public function actionProduct()
    {
        $model = new Product;

        if($model->load(yii::$app->requst->post() && validate()))
            {

            }

        return $this->render('Product',['model'=>$model]);
    }

    public function actionUsersignup()
    {
        $model = new Usersignup();
        if($model->load(yii::$app->request->post())){
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                
     
                   for ($i = 0; $i < 7; $i++) {
                       $index = rand(0, strlen($characters) - 1);
                       $randomString .= $characters[$index];
                                               }
          // print_r($model);
          // exit;
             $model->username=$_POST['Usersignup']['username'];
             $model->password=$_POST['Usersignup']['password'];
             $model->phone=$_POST['Usersignup']['phone'];
             $model->status=1;
             $model->authKey=$randomString;
             $model->First_name=$_POST['Usersignup']['First_name'];
             $model->Last_name=$_POST['Usersignup']['Last_name'];
             $model->Email=$_POST['Usersignup']['Email'];
             $model->save();
        $result=Products::find()->All();
        return $this->render('index',['result' => $result]);
        }
        return $this->render('usersignup',['model' => $model]);
    }

    public function actionView()
    {
        // print_r($_POST);
        $p = $_POST['viewproduct'];
        $model = new View;
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
                            SELECT *
                              FROM products
                              WHERE p_id = '$p'
                        ");
        $result = $command->queryAll();

        return $this->render('view',['result'=>$result]);
    }

    public function actionOrders()
    {
          $uid =Yii::$app->user->identity->id;
           If (\Yii::$app->request->isPost) {
                if (\Yii::$app->request->post('cancle')) {
                  $pid= Yii::$app->request->post('cancle');
                  $connection = Yii::$app->getDb();
                  $connection->createCommand()
                             ->delete('orders', ['p_id' => $pid])
                             ->execute();
                  $result = Orders::find()
                            ->where(['usr_id' => $uid])
                            ->All();
                  return $this->render('orders',['result'=>$result]);
                }
              }
              $result = Orders::find()
                            ->where(['usr_id' => $uid])
                            ->All();
                  
          return $this->render('orders',['result'=>$result]);
    }

     public function actionSettings()
    {

         $model = new User();
         
         $uid =Yii::$app->user->identity->id;


         if($model->load(yii::$app->request->post())){
           $mod=$_POST['User']['oldpass'];
           $username=$_POST['User']['username'];
           $First_name=$_POST['User']['First_name'];
           $Last_name=$_POST['User']['Last_name'];
           $phone=$_POST['User']['phone'];
           $Email=$_POST['User']['Email'];
           $newpas=$_POST['User']['password'];
           $connection = Yii::$app->getDb();
           $command = $connection->createCommand("
                            SELECT *
                              FROM user
                             WHERE u_id='$uid'
                        ");
           $result=$command->queryAll();
           
          if ($mod==$result[0]['password']) {
            if ($mod==$newpas) {
              Yii::$app->session->setFlash('danger', "New Password Should not be same as Old Password.");
            }else{
           $connection1 = Yii::$app->getDb();
           $res=$connection1->createCommand()
                      ->update('user', ['username' => $username, 'First_name' => $First_name, 'Last_name'=>$Last_name, 'phone'=>$phone, 'Email'=>$Email, 'password'=>$newpas], ['u_id' => $uid])
                      ->execute();
      
           
           Yii::$app->session->setFlash('success', "Profile is Updated Successfully.");
           }
          }else{
            Yii::$app->session->setFlash('danger', "Old Password is not Corect.");
          }
         }
          return $this->render('settings',['model'=>$model]);
    }
}
