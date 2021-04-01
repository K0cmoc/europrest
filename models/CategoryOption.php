<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class CategoryOption
 * @package app\models
 * @property int id
 * @property string name
 * @property int category_id
 */

class CategoryOption extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%category_option}}';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}