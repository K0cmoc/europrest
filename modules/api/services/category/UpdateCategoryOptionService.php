<?php


namespace app\modules\api\services\category;


use app\models\CategoryOption;
use app\modules\api\forms\category\UpdateCategoryOptionForm;

class UpdateCategoryOptionService
{
    public function update(UpdateCategoryOptionForm $updateCategoryOptionForm)
    {
        $categoryOption = CategoryOption::findOne($updateCategoryOptionForm->id);
        $categoryOption->name = $updateCategoryOptionForm->name;
        $categoryOption->save(false);
        return $categoryOption;
    }

}