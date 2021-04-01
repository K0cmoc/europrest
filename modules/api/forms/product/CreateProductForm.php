<?php


namespace app\modules\api\forms\product;


use app\models\Category;
use app\models\CategoryOption;
use yii\base\Model;

/**
 * @OA\Schema(
 *     description="Product create request",
 *     title="Product create",
 *     type="object",
 *     @OA\Property(property="name", type="string", example="Meat"),
 *     @OA\Property(property="description", type="string", example="Description of the product"),
 *     @OA\Property(property="price", type="integer", example=2000),
 *     @OA\Property(
 *          property="categories",
 *          type="array",
 *          @OA\Items(
 *              @OA\Property(property="categoryId", type="integer", example=1),
 *              @OA\Property(
 *                  property="options",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="optionId", type="integer", example=1),
 *                      @OA\Property(property="value", type="string", example="small"),
 *                  )
 *              )
 *          )
 *     ),
 * )
 */

class CreateProductForm extends Model
{
    public $name;
    public $description;
    public $price;
    public $categories;

    public function rules()
    {
        return [
            [
                'name', 'required', 'message' => 'Введите название товара'
            ],
            [
                'description', 'required', 'message' => 'Введите описание товара'
            ],
            [
                'price', 'required', 'message' => 'Введите цену товара'
            ],
            [
                'categories', 'categoriesValidator'
            ],
        ];
    }

    public function categoriesValidator($attribute, $params = [])
    {
        if(!$this->categories){
            return;
        }
        if(!is_array($this->categories)){
            $this->addError('categories', 'Categories must be an array');
            return;
        }
        foreach ($this->categories as $categoryData){
            if(!isset($categoryData['categoryId'])){
                $this->addError('categories', 'Enter category id');
                return;
            }
            if(!isset($categoryData['options'])){
                $this->addError('categories', 'Enter category options');
                return;
            }
            if (!is_array($categoryData['options'])){
                $this->addError('categories', 'Option for category must be an array');
            }
            $category = Category::findOne($categoryData['categoryId']);
            if(!$category){
                $this->addError('categories', 'Category not exists');
                return;
            }
            foreach ($categoryData['options'] as $optionData){
                if(!isset($optionData['optionId'])){
                    $this->addError('categories', 'Option Id is not defined');
                    return;
                }
                if(!isset($optionData['value'])){
                    $this->addError('categories', 'Option value is not defined');
                    return;
                }
                $option = CategoryOption::findOne(['id' => $optionData['optionId'], 'category_id' => $categoryData['categoryId']]);
                if(!$option){
                    $this->addError('categories', 'Option is not exist');
                    return;
                }
            }
        }
    }

    public function formName()
    {
        return "";
    }

}