<?php


namespace app\modules\api\dataView\product;

use app\models\Product;

/**
 * @OA\Schema(
 *   description="Product create response",
 *   title="Product create",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */


class CreateProductDataView
{
    private Product $product;

    /**
     * CreateProductDataView constructor.
     * @param $product
     */

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function productCreateResponse()
    {
        return ['id' => 'Create product with id = ' . $this->product->id];
    }
}