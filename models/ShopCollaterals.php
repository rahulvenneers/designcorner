<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_collaterals".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property integer $col_type_id
 * @property string $height
 * @property string $width
 * @property string $nos
 * @property string $job_order
 * @property integer $done_by
 * @property string $design
 * @property string $location
 * @property string $install_date
 * @property string $removal_date
 * @property string $status
 *
 * @property Shops $shop
 * @property CollateralType $colType
 * @property OutSourceCom $doneBy
 */
class ShopCollaterals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $designImage;
    public $locationImage;
    public static function tableName()
    {
        return 'shop_collaterals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'col_type_id', 'height', 'width', 'nos', 'job_order', 'done_by', 'design', 'location', 'status'], 'required'],
            [['shop_id', 'col_type_id', 'done_by'], 'integer'],
            [['install_date', 'removal_date'], 'safe'],
            [['status'], 'string'],
            [['height', 'width', 'job_order'], 'string', 'max' => 10],
            [['nos'], 'string', 'max' => 5],
            [['design', 'location'], 'string', 'max' => 40],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
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
            'shop_id' => 'Shop ID',
            'col_type_id' => 'Collateral Type',
            'height' => 'Height',
            'width' => 'Width',
            'nos' => 'Nos',
            'job_order' => 'Job Order',
            'done_by' => 'Done By',
            'design' => 'Design',
            'location' => 'Location',
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
