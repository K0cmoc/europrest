<?php


namespace app\modules\api\services\category;


use app\models\CategoryOption;
use app\modules\api\forms\category\OptionAddForm;

class OptionAddService
{
    public function add(OptionAddForm $optionAddForm)
    {
        $categoryOption = new CategoryOption([
            'name' => $optionAddForm->name,
            'category_id' => $optionAddForm->categoryId,
        ]);
        $categoryOption->save(false);
        return $categoryOption;
    }

}