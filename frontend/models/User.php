<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $u_id
 * @property string $username
 * @property string $First_name
 * @property string $Last_name
 * @property string $phone
 * @property string $password
 * @property string $Email
 * @property int $status
 * @property string $authKey
 *
 * @property Orders[] $orders
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $oldpass;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'First_name', 'Last_name', 'phone', 'password', 'Email','oldpass'], 'required'],
            [['username', 'First_name', 'Last_name'], 'string', 'max' => 100],
            [['phone', 'password', 'Email', 'oldpass'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'U ID',
            'username' => 'Username',
            'First_name' => 'First Name',
            'Last_name' => 'Last Name',
            'phone' => 'Phone',
            'password' => 'Password',
            'Email' => 'Email',
            'oldpass' => 'Old Password'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['usr_id' => 'u_id']);
    }
}
