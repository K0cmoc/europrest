<?php


namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Product
 * @package app\models
 * @property int id
 * @property string name
 * @property string description
 * @property int price
 */

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('category_product', ['product_id' => 'id']);
    }
}