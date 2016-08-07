<?php

namespace app\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo_main
 * @property string $logo
 * @property string $status
 *
 * @property Shops[] $shops
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imgMain;
    public $imgIcon;
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['imgMain'], 'file', 'skipOnEmpty' => true,'on'=>'update', 'extensions' => 'png, jpg'],
            [['imgIcon'], 'file', 'skipOnEmpty' => true,'on'=>'update', 'extensions' => 'png, jpg'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['logo_main', 'logo'], 'string', 'max' => 40],
            [['name'], 'unique'],
            [['logo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'logo_main' => 'Logo Main',
            'logo' => 'Logo Icon',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shops::className(), ['brand_id' => 'id']);
    }
}
