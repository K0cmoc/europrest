<?php


namespace app\modules\api\dataView\category;

use app\models\Category;

/**
 * @OA\Schema(
 *   description="Category delete",
 *   title="Category delete",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class DeleteCategoryDataView
{
    private Category $category;

    /**
     * DeleteProductDataView constructor.
     * @param $category
     */

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function data()
    {
        return ['id' => 'Successfully deleted category with id = ' . $this->category->id];
    }
}