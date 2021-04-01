<?php


namespace app\modules\api\services\category;


use app\models\Category;
use app\modules\api\forms\category\UpdateCategoryForm;

class UpdateCategoryService
{
    public function update(Category $category, UpdateCategoryForm $updateCategoryForm)
    {
        $category->name = $updateCategoryForm->name;
        $category->save(false);
        return $category;
    }

}