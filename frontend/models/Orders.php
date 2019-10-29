<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $o_id
 * @property int $p_id
 * @property int $usr_id
 * @property string $ordered_date
 * @property string $Amount
 *
 * @property Products $p
 * @property User $usr
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
            [['p_id', 'usr_id', 'ordered_date', 'Amount'], 'required'],
            [['p_id', 'usr_id'], 'integer'],
            [['ordered_date'], 'safe'],
            [['Amount'], 'string', 'max' => 50],
            [['p_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['p_id' => 'p_id']],
            [['usr_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usr_id' => 'u_id']],
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
            'ordered_date' => 'Ordered Date',
            'Amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Products::className(), ['p_id' => 'p_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsr()
    {
        return $this->hasOne(User::className(), ['u_id' => 'usr_id']);
    }
}
