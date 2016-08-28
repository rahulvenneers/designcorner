<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "joint_col_details".
 *
 * @property integer $id
 * @property integer $joint_col_id
 * @property integer $shop_id
 * @property integer $pro_id
 *
 * @property JointCollateral $jointCol
 * @property Shops $shop
 * @property Promotions $pro
 */
class JointColDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'joint_col_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['joint_col_id', 'shop_id', 'pro_id'], 'required'],
            [['joint_col_id', 'shop_id', 'pro_id'], 'integer'],
            [['joint_col_id'], 'exist', 'skipOnError' => true, 'targetClass' => JointCollateral::className(), 'targetAttribute' => ['joint_col_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promotions::className(), 'targetAttribute' => ['pro_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'joint_col_id' => 'Joint Col ID',
            'shop_id' => 'Shop ID',
            'pro_id' => 'Pro ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJointCol()
    {
        return $this->hasOne(JointCollateral::className(), ['id' => 'joint_col_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Promotions::className(), ['id' => 'pro_id']);
    }
}
