<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm2;
use yii\data\ArrayDataProvider;
use app\models\Products;
use app\models\Customers;
use app\models\View;
use app\models\Addproducts;
use yii\web\UploadedFile;
use app\models\Orders;
use app\models\Adminsignup;

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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['usersignup', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                     [
                        'actions' => ['index', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                     [
                        'actions' => ['customers', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['addproducts', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['orders', 'index'],
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
        $name=Yii::$app->request->post('inputTxt');
        If (\Yii::$app->request->isPost && ! empty($name) ){  

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                            SELECT *
                              FROM products WHERE p_name LIKE '%$name%'
                        ");
            $result = $command->queryAll();                        
            $dataprovider = new ArrayDataProvider([
                            'allModels' =>  $result,
                            'pagination' => [
                        'pageSize'=>5,
                                            ],
                        ]);
        }else{ 
        $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
                            SELECT *
                              FROM products
                        ");
                $result = $command->queryAll();
                $dataprovider = new ArrayDataProvider([
                        'allModels' =>  $result,
                        'pagination' => [
                    'pageSize'=>10,
                                        ],
                    ]);
                }
        if (\Yii::$app->request->post('buy')) {
                    $uid= Yii::$app->request->post('close');
                        $dt=date('Y-m-d H:i:s');
                        // echo $dt;
                        // exit;
                        $sqli = $connection->createCommand("UPDATE transactions SET endDate = '$dt' WHERE tid = '$uid'
                        ")->execute();
                        $sql = $connection->createCommand("UPDATE transactions SET status = 2 WHERE tid = '$uid'
                        ")->execute();
                   
                                                           }
        return $this->render('index',['dataprovider' => $dataprovider]);
    }


    public function actionDelete()
    {

        $connection = Yii::$app->getDb();
        $id=$_GET['id'];
        // $command = $connection->createCommand("
        //                     DELETE FROM users
        //                     WHERE id= '$id';
        //                 ")->execute();
        $model = Products::findOne(['p_id' => $id]);
        // print_r($model);
        // exit;
        $model->delete();
        $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
                            SELECT *
                              FROM products
                        ");
                $result = $command->queryAll();
        // exit;                        
        $dataprovider = new ArrayDataProvider([
                        'allModels' =>  $result,
                        'pagination' => [
                    'pageSize'=>50,
                                        ],
                     'sort' => [

                    'attributes' => ['a_id','p_name','details','price',],

                            ],
                    ]);
        Yii::$app->session->setFlash('success', "Product Deleted Successfully.");
        return $this->render('index',['dataprovider' => $dataprovider]);
    }

    public function actionUpdate()
    {
        $model = new Addproducts;
        $id=$_GET['id'];
        $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
                            SELECT *
                              FROM products WHERE p_id = $id
                        ");
                $result = $command->queryAll();
                if($model->load(yii::$app->request->post())){
                    $p_name=$_POST['Addproducts']['p_name'];
                    $details=$_POST['Addproducts']['details'];
                    $price=$_POST['Addproducts']['price'];
                    $connection1 = Yii::$app->getDb();
                    $res=$connection1->createCommand()
                      ->update('products', ['p_name' => $p_name, 'details' => $details, 'price'=>$price], ['p_id' => $id])
                      ->execute();
                Yii::$app->session->setFlash('success', "Product Updated Successfully.");
                }
        return $this->render('update',['model' => $model,'result'=>$result]);
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm2();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $id=Yii::$app->user->identity->a_id;
            $_SESSION['A_ID']=$id;
            // echo $_SESSION['A_ID'];
            // exit;
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

        return $this->goHome();
    }


     public function actionProduct()
    {
        $model = new Product;

        if($model->load(yii::$app->requst->post() && validate()))
            {

            }

        return $this->render('Products',['model'=>$model]);
    }

     public function actionCustomers()
    {
        $model = new Customers;
        $name=Yii::$app->request->post('inputTxt');
        If (\Yii::$app->request->isPost && ! empty($name) ){  

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                            SELECT *
                              FROM user WHERE username LIKE '%$name%'
                        ");
            $result = $command->queryAll();                        
            $dataprovider = new ArrayDataProvider([
                            'allModels' =>  $result,
                            'pagination' => [
                        'pageSize'=>10,
                                            ],
                        ]);
            return $this->render('customers',['dataprovider' => $dataprovider]);
        }else{ 
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
                            SELECT *
                              FROM user
                        ");
                $result = $command->queryAll();
                $dataprovider = new ArrayDataProvider([
                        'allModels' =>  $result,
                        'pagination' => [
                    'pageSize'=>10,
                                        ],
                    ]);

        return $this->render('customers',['dataprovider' => $dataprovider]);
        }
    }

public function actionUsersignup()
    {
        $model = new Adminsignup();
        if($model->load(yii::$app->request->post())){
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                
     
                   for ($i = 0; $i < 7; $i++) {
                       $index = rand(0, strlen($characters) - 1);
                       $randomString .= $characters[$index];
                                               }
          // print_r($model);
          // exit;
             $model->username=$_POST['Adminsignup']['username'];
             $model->password=$_POST['Adminsignup']['password'];
             $model->phone=$_POST['Adminsignup']['phone'];
             $model->status=1;
             $model->authKey=$randomString;
             $model->First_name=$_POST['Adminsignup']['First_name'];
             $model->Last_name=$_POST['Adminsignup']['Last_name'];
             $model->Email=$_POST['Adminsignup']['Email'];
             $model->save();
             $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
                            SELECT *
                              FROM products
                        ");
                $result = $command->queryAll();
                $dataprovider = new ArrayDataProvider([
                        'allModels' =>  $result,
                        'pagination' => [
                    'pageSize'=>10,
                                        ],
                    ]);
        
        return $this->render('index',['dataprovider' => $dataprovider]);
        }
        return $this->render('usersignup',['model' => $model]);
    }

    public function actionView()
    {
        $model = new View;
        $id = $_GET['id'];
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
                            SELECT *
                              FROM products
                              WHERE p_id = $id
                        ");
        $result = $command->queryAll();
        return $this->render('view',['result' => $result]);
    }

     public function actionAddproducts()
    {
        $model = new Addproducts;
         if($model->load(yii::$app->request->post())){

            //getting instance of upload file
            $imagename = $model->p_name;
            $model->file=UploadedFile::getInstance($model,'file');
            $model->file->saveAs('images/' .$imagename.'.' .$model->file->extension );

             $model->path = 'images/' .$imagename.'.' .$model->file->extension;
             $model->a_id = $_SESSION['A_ID'];;
             $model->p_name=$_POST['Addproducts']['p_name'];
             $model->details=$_POST['Addproducts']['details'];
             $model->price=$_POST['Addproducts']['price'];
             $model->save();
        Yii::$app->session->setFlash('success', "Product Added Successfully.");
         }
        return $this->render('addproducts',['model' => $model]);
    }

    public function actionOrders()
    {
        $model = new Orders;
        $name=Yii::$app->request->post('inputTxt');
        If (\Yii::$app->request->isPost && ! empty($name) ){  

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                            SELECT *
                              FROM orders WHERE product_name LIKE '%$name%'
                        ");
            $result = $command->queryAll();                        
            $dataprovider = new ArrayDataProvider([
                            'allModels' =>  $result,
                            'pagination' => [
                        'pageSize'=>10,
                                            ],
                        ]);
            return $this->render('orders',['dataprovider'=>$dataprovider]);
        }else{ 
        $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
                            SELECT *
                              FROM orders
                        ");
        $result = $command->queryAll();
        $dataprovider = new ArrayDataProvider([
                        'allModels' =>  $result,
                        'pagination' => [
                    'pageSize'=>10,
                                        ],
                    ]);
        return $this->render('orders',['dataprovider'=>$dataprovider]);
        }
    }
}
