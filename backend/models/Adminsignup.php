<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $a_id
 * @property string $username
 * @property string $First_name
 * @property string $Last_name
 * @property string $authKey
 * @property int $status
 * @property string $phone
 * @property string $password
 * @property string $Email
 *
 * @property Products[] $products
 */
class Adminsignup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['First_name', 'Last_name', 'authKey', 'status', 'Email'], 'required'],
            [['status'], 'integer'],
            [['username', 'First_name', 'Last_name', 'authKey'], 'string', 'max' => 100],
            [['phone', 'password', 'Email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'a_id' => 'A ID',
            'username' => 'Username',
            'First_name' => 'First Name',
            'Last_name' => 'Last Name',
            'authKey' => 'Auth Key',
            'status' => 'Status',
            'phone' => 'Phone',
            'password' => 'Password',
            'Email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['a_id' => 'a_id']);
    }
}
