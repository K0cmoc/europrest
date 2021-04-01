<?php


namespace app\modules\api\dataView\product;

use app\models\Product;

/**
 * @OA\Schema(
 *   description="Product update response",
 *   title="Product update",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */


class UpdateProductDataView
{
    private Product $product;

    /**
     * UpdateProductDataView constructor.
     * @param $product
     */

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function productUpdateResponse()
    {
        return ['id' => 'Successfully updated product with id = ' . $this->product->id];
    }
}