<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $p_id
 * @property int $a_id
 * @property string $p_name
 * @property string $path
 * @property string $details
 * @property string $price
 *
 * @property Cart[] $carts
 * @property Orders[] $orders
 * @property Admin $a
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a_id', 'p_name', 'path', 'details', 'price'], 'required'],
            [['a_id'], 'integer'],
            [['p_name'], 'string', 'max' => 100],
            [['path', 'details'], 'string', 'max' => 10000],
            [['price'], 'string', 'max' => 50],
            [['a_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['a_id' => 'a_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'a_id' => 'A ID',
            'p_name' => 'Product Name',
            'path' => 'Path',
            'details' => 'Details',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['p_id' => 'p_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['p_id' => 'p_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getA()
    {
        return $this->hasOne(Admin::className(), ['a_id' => 'a_id']);
    }
}
