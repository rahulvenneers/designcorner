<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shops".
 *
 * @property integer $id
 * @property string $contact_no
 * @property string $email_id
 * @property integer $emirates_id
 * @property integer $store_id
 * @property integer $brand_id
 * @property string $latitude
 * @property string $longitude
 * @property string $is_delete
 *
 * @property PromotionDetails[] $promotionDetails
 * @property Stores $store
 * @property Brands $brand
 * @property Emirates $emirates
 */
class Shops extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'shops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_no', 'email_id', 'emirates_id', 'store_id', 'brand_id' ], 'required'],
            [['emirates_id', 'store_id', 'brand_id'], 'integer'],
            
            [['is_delete'], 'string'],
            [['contact_no'], 'string', 'max' => 15],
            [['email_id'], 'email'],
            [['latitude', 'longitude'], 'string', 'max' => 20],
            [['email_id'], 'unique'],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['emirates_id'], 'exist', 'skipOnError' => true, 'targetClass' => Emirates::className(), 'targetAttribute' => ['emirates_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact_no' => 'Contact No',
            'email_id' => 'Email ID',
            'emirates_id' => 'Emirates ID',
            'store_id' => 'Store ID',
            'brand_id' => 'Brand ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'is_delete' => 'Is Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionDetails()
    {
        return $this->hasMany(PromotionDetails::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmirates()
    {
        return $this->hasOne(Emirates::className(), ['id' => 'emirates_id']);
    }
    public function getMainboards(){
        return $this->hasMany(MainBoards::className(), ['shop_id' => 'id'])->where(['status'=>'live']);
    }
}
