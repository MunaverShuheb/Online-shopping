<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $o_id
 * @property int $p_id
 * @property int $usr_id
 * @property string $product_name
 * @property string $details
 * @property string $path
 * @property int $Amount
 * @property string $ordered_date
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_id', 'usr_id', 'product_name', 'details', 'path', 'Amount', 'ordered_date'], 'required'],
            [['p_id', 'usr_id', 'Amount'], 'integer'],
            [['ordered_date'], 'safe'],
            [['product_name'], 'string', 'max' => 100],
            [['details'], 'string', 'max' => 10000],
            [['path'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'o_id' => 'O ID',
            'p_id' => 'P ID',
            'usr_id' => 'Usr ID',
            'product_name' => 'Product Name',
            'details' => 'Details',
            'path' => 'Path',
            'Amount' => 'Amount',
            'ordered_date' => 'Ordered Date',
        ];
    }
}
