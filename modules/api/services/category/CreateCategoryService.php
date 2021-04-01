<?php

namespace app\modules\api\services\category;

use app\models\Category;
use app\models\CategoryOption;
use app\modules\api\forms\category\CreateCategoryForm;

class CreateCategoryService
{
    public function create(CreateCategoryForm $createCategoryForm)
    {
        $category = new Category([
            'name' => $createCategoryForm->name,
        ]);
        $category->save(false);
        if(isset($createCategoryForm->categoryOptions)){
            foreach ($createCategoryForm->categoryOptions as $option){
                $categoryOption = new CategoryOption([
                    'name' => $option['name'],
                    'category_id' => $category->id,
                ]);
                $categoryOption->save(false);
            }
        }
        return $category;
    }
}