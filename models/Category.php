<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 *
 * @property ShopCategory[] $shopCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo'], 'required'],
            [['name'], 'string', 'max' => 20],
            [['logo'], 'string', 'max' => 40],
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
            'logo' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopCategories()
    {
        return $this->hasMany(ShopCategory::className(), ['category_id' => 'id']);
    }
}
