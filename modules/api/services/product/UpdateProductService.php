<?php


namespace app\modules\api\services\product;

use app\models\Product;
use app\modules\api\forms\product\UpdateProductForm;

class UpdateProductService
{
    public function update(Product $product, UpdateProductForm $updateProductForm)
    {
        $product->name = $updateProductForm->name;
        $product->description = $updateProductForm->description;
        $product->price = $updateProductForm->price;

        $product->save(false);

        return $product;
    }
}