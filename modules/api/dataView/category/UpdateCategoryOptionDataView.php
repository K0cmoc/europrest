<?php


namespace app\modules\api\dataView\category;

use app\models\CategoryOption;

/**
 * @OA\Schema(
 *   description="Category Option update response",
 *   title="CategoryOption update",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class UpdateCategoryOptionDataView
{
    private CategoryOption $categoryOption;

    /**
     * UpdateCategoryOptionDataView constructor.
     * @param $categoryOption
     */

    public function __construct($categoryOption)
    {
        $this->categoryOption = $categoryOption;
    }

    public function categoryUpdateResponse()
    {
        return ['id' => 'Successfully updated category option with id = ' . $this->categoryOption->id];
    }

}