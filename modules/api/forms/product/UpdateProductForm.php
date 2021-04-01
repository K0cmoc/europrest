<?php


namespace app\modules\api\forms\product;


use app\models\Product;
use yii\base\Model;

/**
 * @OA\Schema(
 *   description="Product update request",
 *   title="Product update",
 *   @OA\Property(property="name", type="string", example="AnotherMeat"),
 *   @OA\Property(property="description", type="string", example="Another Description of the product"),
 *   @OA\Property(property="price", type="integer", example="2000"),
 * )
 */

class UpdateProductForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;

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
        ];
    }

    public function formName()
    {
        return "";
    }
}