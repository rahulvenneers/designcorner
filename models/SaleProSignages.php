<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_pro_signages".
 *
 * @property integer $id
 * @property string $job_order
 * @property integer $col_type_id
 * @property string $height
 * @property string $width
 * @property string $nos
 * @property string $design
 * @property integer $done_by
 * @property integer $pro_id
 * @property integer $shop_id
 * @property string $install_date
 * @property string $removal_date
 * @property string $status
 *
 * @property Shops $shop
 * @property Promotions $pro
 * @property CollateralType $colType
 * @property OutSourceCom $doneBy
 */
class SaleProSignages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $image;
    public static function tableName()
    {
        return 'sale_pro_signages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_order', 'col_type_id', 'height', 'width', 'nos', 'done_by', 'pro_id', 'shop_id'], 'required'],
            [['col_type_id', 'done_by', 'pro_id', 'shop_id'], 'integer'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['install_date', 'removal_date','design'], 'safe'],
            [['status'], 'string'],
            [['job_order', 'height', 'width'], 'string', 'max' => 10],
            [['nos'], 'string', 'max' => 5],
            [['design'], 'string', 'max' => 40],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promotions::className(), 'targetAttribute' => ['pro_id' => 'id']],
            [['col_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CollateralType::className(), 'targetAttribute' => ['col_type_id' => 'id']],
            [['done_by'], 'exist', 'skipOnError' => true, 'targetClass' => OutSourceCom::className(), 'targetAttribute' => ['done_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_order' => 'Job Order',
            'col_type_id' => 'Col Type ID',
            'height' => 'Height',
            'width' => 'Width',
            'nos' => 'Nos',
            'design' => 'Design',
            'done_by' => 'Done By',
            'pro_id' => 'Pro ID',
            'shop_id' => 'Shop ID',
            'install_date' => 'Install Date',
            'removal_date' => 'Removal Date',
            'status' => 'Status',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColType()
    {
        return $this->hasOne(CollateralType::className(), ['id' => 'col_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoneBy()
    {
        return $this->hasOne(OutSourceCom::className(), ['id' => 'done_by']);
    }
}
