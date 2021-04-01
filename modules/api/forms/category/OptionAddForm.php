<?php


namespace app\modules\api\forms\category;


use app\models\Category;
use yii\base\Model;

/**
 * @OA\Schema(
 *   description="CategoryOption add request",
 *   title="CategoryOption add",
 *   @OA\Property(property="category_id", type="integer", example="1"),
 *   @OA\Property(property="name", type="string", example="abs"),
 * )
 */

class OptionAddForm extends Model
{
    public $categoryId;
    public $name;

    public function rules()
    {
        return [
            [
                'categoryId', 'required', 'message' => 'Введите id категории, для которой хотите добавить характеристику'
            ],
            [
                'categoryId', 'categoryIdValidation'
            ],
            [
                'name', 'required', 'message' => 'Заполните имя характеристики для категории'
            ]
        ];
    }

    public function categoryIdValidation($attribute, $params)
    {
        if(!Category::findOne($this->{$attribute})){
            $this->addError($attribute, 'Категория с таким id не найдена');
            return;
        }
    }

    public function formName()
    {
        return "";
    }
}