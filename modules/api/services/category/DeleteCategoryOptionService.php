<?php


namespace app\modules\api\services\category;


use app\models\CategoryOption;
use app\modules\api\forms\category\DeleteCategoryOptionForm;

class DeleteCategoryOptionService
{
    public function delete(DeleteCategoryOptionForm $deleteCategoryOptionForm)
    {
        $categoryOption = CategoryOption::findOne($deleteCategoryOptionForm->id);
        $categoryOption->delete();
        return;
    }

}