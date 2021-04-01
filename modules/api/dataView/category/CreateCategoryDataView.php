<?php


namespace app\modules\api\dataView\category;

use app\models\Category;

/**
 * @OA\Schema(
 *   description="Category create response",
 *   title="Category create",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class CreateCategoryDataView
{
    private Category $category;

    /**
     * CreateCategoryDataView constructor.
     * @param $category
     */

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function categoryCreateResponse()
    {
        return ['id' => 'Create category with id = ' . $this->category->id];
    }

}