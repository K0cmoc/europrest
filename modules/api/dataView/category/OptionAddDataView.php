<?php


namespace app\modules\api\dataView\category;

use app\models\CategoryOption;

/**
 * @OA\Schema(
 *   description="Category Option Add response",
 *   title="CategoryOption add",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class OptionAddDataView
{
    private CategoryOption $categoryOption;

    /**
     * OptionAddDataView constructor.
     * @param $categoryOption
     */

    public function __construct($categoryOption)
    {
        $this->categoryOption = $categoryOption;
    }

    public function optionAddResponse()
    {
        return [
            'category_id' => 'For category with id = ' . $this->categoryOption->category_id . ' successfully created option',
            'id' => 'Option id = ' . $this->categoryOption->id];
    }
}