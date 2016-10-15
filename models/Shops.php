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
            [['contact_no', 'email_id', 'emirates_id', 'store_id', 'brand_id','manager','sqr_feet' ], 'required'],
            [['emirates_id', 'store_id', 'brand_id'], 'integer'],
            [['is_delete'], 'string'],
            [['contact_no'], 'string', 'max' => 15],
            [['sqr_feet'], 'string', 'max' => 10],
            [['email_id'], 'email'],
            [['latitude', 'longitude','manager'], 'string', 'max' => 20],
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
            'manager'=>'Manager',
            'contact_no' => 'Contact No',
            'email_id' => 'Email ID',
            'sqr_feet'=>'Square Feet',
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
    public function getShopcategory()
    {
        return $this->hasMany(ShopCategory::className(), ['shop_id' => 'id']);
    }
    public function getShopcol()
    {
        return $this->hasMany(ShopCollaterals::className(), ['shop_id' => 'id']);
    }
    public function getJoincol()
    {
        return $this->hasMany(JointColDetails::className(), ['shop_id' => 'id']);
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
    public function getSalesignages(){
        return $this->hasMany(SaleProSignages::className(), ['shop_id' => 'id']);
    }
}
