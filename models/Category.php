<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Category
 * @package app\models
 * @property int id
 * @property string name
 */

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%category}}';
    }

    public function getCategoryOptions()
    {
        return $this->hasMany(CategoryOption::class, ['category_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('category_product', ['category_id' => 'id']);
    }
}