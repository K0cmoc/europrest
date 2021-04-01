<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class CategoryProduct
 * @package app\models
 * @property int id
 * @property int category_id
 * @property int product_id
 */

class CategoryProduct extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%category_product}}';
    }
}