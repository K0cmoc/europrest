<?php


namespace app\modules\api\dataView\category;


use app\models\Category;

/**
 * @OA\Schema(
 *   description="Category index",
 *   title="Categories",
 *   @OA\Property(property="categories", type="array",
 *     @OA\Items(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="cars"),
 *     )
 *   )
 * )
 */

class IndexCategoryDataView
{
    /**
     * @var Category[]
     */

    private array $categories;


    /**
     * IndexCategoryDataView constructor.
     * @param array $categories
     */

    public function __construct(array $categories)
    {

        $this->categories = $categories;
    }

    public function data()
    {
        $data = [];
        foreach ($this->categories as $category)
        {
            $data[] = [
                'id' => $category->id,
                'name' => $category->name,
            ];
        }
        return $data;
    }
}