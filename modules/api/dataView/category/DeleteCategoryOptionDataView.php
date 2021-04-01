<?php


namespace app\modules\api\dataView\category;

use app\modules\api\forms\category\DeleteCategoryOptionForm;

/**
 * @OA\Schema(
 *   description="Category option delete response",
 *   title="Category delete",
 *   @OA\Property(property="id", type="integer", example="1"),
 * )
 */

class DeleteCategoryOptionDataView
{
    private DeleteCategoryOptionForm $categoryOption;

    /**
     * DeleteCategoryOptionDataView constructor.
     * @param $categoryOption
     */

    public function __construct($categoryOption)
    {
        $this->categoryOption = $categoryOption;
    }

    public function categoryOptionDeleteResponse()
    {
        return ['id' => 'Successfully deleted category option with id = ' . $this->categoryOption->id];
    }
}