<?php


namespace app\modules\api\dataView\category;

use app\models\Category;

/**
 * @OA\Schema(
 *   description="Category update response",
 *   title="Category update",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class UpdateCategoryDataView
{
    private Category $category;

    /**
     * UpdateCategoryDataView constructor.
     * @param $category
     */

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function categoryUpdateResponse()
    {
        return ['id' => 'Successfully updated category with id = ' . $this->category->id];
    }

}