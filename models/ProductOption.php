<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class ProductOption
 * @package app\models
 * @property int id
 * @property string value
 * @property int category_option_id
 * @property int product_id
 */

class ProductOption extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product_option}}';
    }
}