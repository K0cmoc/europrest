<?php


namespace app\modules\api\dataView\product;

use app\models\Product;

/**
 * @OA\Schema(
 *   description="Product delete",
 *   title="Product",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class DeleteProductDataView
{
    private Product $product;

    /**
     * DeleteProductDataView constructor.
     * @param $product
     */

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function data()
    {
        return ['id' => 'Successfully deleted product with id = ' . $this->product->id];
    }

}