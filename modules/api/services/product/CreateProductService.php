<?php


namespace app\modules\api\services\product;


use app\models\CategoryProduct;
use app\models\Product;
use app\models\ProductOption;
use app\modules\api\forms\product\CreateProductForm;

class CreateProductService
{
    public function create(CreateProductForm $createProductForm)
    {
        $product = new Product([
            'name' => $createProductForm->name,
            'description' => $createProductForm->description,
            'price' => $createProductForm->price,
        ]);
        $product->save(false);
        if($createProductForm->categories != null){
            foreach ($createProductForm->categories as $category){
                $categoryProduct = new CategoryProduct([
                    'category_id' => $category['categoryId'],
                    'product_id' => $product->id,
                ]);
                $categoryProduct->save(false);
                if($category['options'] != null){
                    foreach ($category['options'] as $option){
                        $productOption = new ProductOption([
                            'value' => $option['value'],
                            'category_option_id' => $option['optionId'],
                            'product_id' => $product->id
                        ]);
                        $productOption->save(false);
                    }
                }
            }
        }
        return $product;
    }
}