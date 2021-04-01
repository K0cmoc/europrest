<?php


namespace app\modules\api\forms\category;

use app\models\CategoryOption;
use yii\base\Model;

/**
 * @OA\Schema(
 *   description="CategoryOption update request",
 *   title="CategoryOption update",
 *   @OA\Property(property="id", type="integer", example="1"),
 *   @OA\Property(property="name", type="string", example="AnotherCategoryOption"),
 * )
 */

class UpdateCategoryOptionForm extends Model
{
    public $id;
    public $name;

    public function rules()
    {
        return [
            [
                'id', 'required', 'message' => 'Введите id категории'
            ],
            [
                'id', 'idValidation'
            ],
            [
                'name', 'required', 'message' => 'Введите название категории'
            ]
        ];
    }

    public function idValidation($attribute, $params)
    {
        if(!CategoryOption::findOne($this->{$attribute})){
            $this->addError('Характеристики для категории с таким id нет');
        }
    }

    public function formName()
    {
        return "";
    }
}