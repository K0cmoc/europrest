<?php


namespace app\modules\api\forms\category;

use yii\base\Model;

/**
 * @OA\Schema(
 *   description="Category update request",
 *   title="Category update",
 *   @OA\Property(property="name", type="string", example="AnotherCategory"),
 * )
 */

class UpdateCategoryForm extends Model
{
    public $id;
    public $name;

    public function rules()
    {
        return [
            [
                'name', 'required', 'message' => 'Введите название категории'
            ],
        ];
    }

    public function formName()
    {
        return "";
    }
}