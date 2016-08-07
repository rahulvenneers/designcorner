<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promotions".
 *
 * @property integer $id
 * @property string $promotion_code
 * @property string $name
 * @property string $discription
 * @property string $start_date
 * @property string $end_date
 * @property integer $emirates_id
 * @property integer $store_id
 * @property string $permission_letter
 * @property string $status
 *
 * @property PromotionDetails[] $promotionDetails
 * @property Emirates $emirates
 * @property Stores $store
 */
class Promotions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $permission;
    public static function tableName()
    {
        return 'promotions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotion_code', 'name', 'discription', 'start_date', 'end_date', 'emirates_id', 'store_id',  'status'], 'required'],
            [['discription', 'status'], 'string'],
            [['permission'], 'file', 'skipOnEmpty' => true],
            [['start_date', 'end_date'], 'safe'],
            [['emirates_id', 'store_id'], 'integer'],
            [['promotion_code'], 'string', 'max' => 15],
            [['name'], 'string', 'max' => 20],
            [['permission_letter'], 'string', 'max' => 50],
            [['emirates_id'], 'exist', 'skipOnError' => true, 'targetClass' => Emirates::className(), 'targetAttribute' => ['emirates_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promotion_code' => 'Promotion Code',
            'name' => 'Name',
            'discription' => 'Discription',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'emirates_id' => 'Emirates ID',
            'store_id' => 'Store ID',
            'permission_letter' => 'Permission Letter',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionDetails()
    {
        return $this->hasMany(PromotionDetails::className(), ['promotion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmirates()
    {
        return $this->hasOne(Emirates::className(), ['id' => 'emirates_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }
    public function getShops(){
        return $this->hasMany(PromotionDetails::className(), ['promotion_id'=>'id']);
    }
}
