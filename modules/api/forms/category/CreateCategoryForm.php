<?php

namespace app\modules\api\forms\category;

use yii\base\Model;

/**
 * @OA\Schema(
 *   description="Category create request",
 *   title="Category create",
 *   @OA\Property(property="name", type="string", example="cars"),
 *   @OA\Property(property="categoryOptions",type="array",@OA\Items(type="string",example={"name": "size"})),
 * )
 */

class CreateCategoryForm extends Model
{
    public $name;
    public $categoryOptions;

    public function rules()
    {
        return [
            [
                'name', 'required', 'message' => 'Введите название категории'
            ],
            [
                'categoryOptions', 'categoryOptionValidator'
            ]
        ];
    }

    public function categoryOptionValidator($attribute, $params= [])
    {
        if (!$this->categoryOptions){
            return;
        }

        if(!is_array($this->categoryOptions)){
            $this->addError('categoryOptions', 'Category options must be an array');
            return;
        }

        foreach ($this->categoryOptions as $option){
            if(!isset($option['name'])){
                $this->addError('categoryOptions', 'Enter option name');
                return;
            }

        }

    }
    public function formName()
    {
        return "";
    }
}