<?php


namespace app\modules\api\dataView\product;


use app\models\Product;

/**
 * @OA\Schema(
 *   description="Product index",
 *   title="Products",
 *   @OA\Property(property="products", type="array",
 *     @OA\Items(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="meat"),
 *       @OA\Property(property="description", type="string", example="striploin"),
 *       @OA\Property(property="price", type="integer", example="2000"),
 *     )
 *   )
 * )
 */

class IndexProductDataView
{
    /**
     * @var Product[]
     *
     */
    private array $products;


    /**
     * IndexProductDataView constructor.
     * @param array $products
     */

    public function __construct(array $products)
    {

        $this->products = $products;
    }

    public function data()
    {
        $data = [];
        foreach ($this->products as $product)
        {
            $data[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
            ];
        }
        return $data;
    }
}