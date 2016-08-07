<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "out_source_com".
 *
 * @property integer $id
 * @property string $name
 * @property string $address_line_1
 * @property string $address_line_2
 * @property integer $emirates_id
 * @property string $contact_no
 * @property string $email_id
 * @property string $website
 * @property string $status
 *
 * @property Emirates $emirates
 */
class OutSourceCom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'out_source_com';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address_line_1', 'address_line_2', 'emirates_id', 'contact_no', 'email_id', 'website'], 'required'],
            [['emirates_id'], 'integer'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 25],
            [['address_line_1', 'address_line_2', 'website'], 'string', 'max' => 30],
            [['contact_no'], 'string', 'max' => 15],
            [['email_id'], 'string', 'max' => 40],
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
            'name' => 'Name',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'emirates_id' => 'Emirates ID',
            'contact_no' => 'Contact No',
            'email_id' => 'Email ID',
            'website' => 'Website',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmirates()
    {
        return $this->hasOne(Emirates::className(), ['id' => 'emirates_id']);
    }
}
