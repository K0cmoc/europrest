<?php


namespace app\modules\api\forms\category;

use app\models\CategoryOption;
use yii\base\Model;

/**
 * @OA\Schema(
 *   description="CategoryOption delete request",
 *   title="CategoryOption delete",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class DeleteCategoryOptionForm extends Model
{
    public $id;

    public function rules()
    {
        return [
            [
                'id', 'required', 'message' => 'Введите id характеристики для категорие, которую хотите удалить'
            ],
            [
                'id', 'idValidation'
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