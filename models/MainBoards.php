<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "main_boards".
 *
 * @property integer $id
 * @property string $job_order
 * @property string $width
 * @property string $height
 * @property string $done_by
 * @property string $out_source_name
 * @property string $image
 * @property integer $shop_id
 *
 * @property Shops $shop
 */
class MainBoards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $board;
    public static function tableName()
    {
        return 'main_boards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_order', 'width', 'height', 'done_by',  'shop_id'], 'required'],
            [['done_by'], 'string'],
            [['board'],'file' ,'skipOnEmpty' => true,'extensions' => 'pdf, jpg,png', 'maxSize' => 112000, 'tooBig' => 'Limit is 500KB'],
            [['out_source_name'], 'required', 'whenClient' => function($model) {
                return $model->done_by == 'out_source';
            }, 'whenClient' => "function (attribute, value) {
            return $('#mainboards-done_by').val() == 'out_source';
            }"],
            [['shop_id'], 'integer'],
            [['job_order', 'width', 'height'], 'string', 'max' => 15],
            [['out_source_name'], 'string', 'max' => 20],
            [['image'], 'string', 'max' => 70],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
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
            'width' => 'Width',
            'height' => 'Height',
            'done_by' => 'Done By',
            'out_source_name' => 'Out Source Name',
            'image' => 'Image',
            'shop_id' => 'Shop ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }
}
