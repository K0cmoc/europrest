<?php


namespace app\modules\api\dataView\category;

use app\models\Product;

/**
 * @OA\Schema(
 *   description="Product at Category index",
 *   title="Categories",
 *   @OA\Property(property="products", type="array",
 *     @OA\Items(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="volvo"),
 *     )
 *   )
 * )
 */

class ProductCategoryDataView
{
    /**
     * @var Product[]
     */

    private array $products;


    /**
     * ProductCategoryDataView constructor.
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
            ];
        }
        return $data;
    }
}