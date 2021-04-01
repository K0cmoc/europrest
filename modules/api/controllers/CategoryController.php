<?php


namespace app\modules\api\controllers;


use app\models\Category;
use app\modules\api\dataView\category\CreateCategoryDataView;
use app\modules\api\dataView\category\DeleteCategoryDataView;
use app\modules\api\dataView\category\DeleteCategoryOptionDataView;
use app\modules\api\dataView\category\OptionAddDataView;
use app\modules\api\dataView\category\ProductCategoryDataView;
use app\modules\api\dataView\category\UpdateCategoryDataView;
use app\modules\api\dataView\category\UpdateCategoryOptionDataView;
use app\modules\api\forms\category\CreateCategoryForm;
use app\modules\api\forms\category\DeleteCategoryOptionForm;
use app\modules\api\forms\category\OptionAddForm;
use app\modules\api\forms\category\UpdateCategoryForm;
use app\modules\api\forms\category\UpdateCategoryOptionForm;
use app\modules\api\services\category\CreateCategoryService;
use app\modules\api\services\category\DeleteCategoryOptionService;
use app\modules\api\services\category\OptionAddService;
use app\modules\api\services\category\UpdateCategoryOptionService;
use app\modules\api\services\category\UpdateCategoryService;
use app\modules\api\dataView\category\IndexCategoryDataView;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CategoryController extends Controller
{
    public $enableCsrfValidation = false;


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'index',
                'product',
                'option-add',
                'option-update',
                'option-delete'
            ],
        ];

        return $behaviors;
    }
    /**
     * @OA\Get(
     *   path="/api/category",
     *   tags={"Category"},
     *   @OA\Response(
     *     response="200",
     *     description="Category",
     *     @OA\JsonContent(ref="#/components/schemas/IndexCategoryDataView")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionIndex()
    {
        $categories = Category::find()->all();
        $indexDataView = new IndexCategoryDataView($categories);
        return $this->renderJson($indexDataView->data());
    }

    /**
     * @OA\Get(
     *   path="/api/category/{id}",
     *   tags={"Category"},
     *     @OA\Parameter(
     *         description="Category id to show products",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *   @OA\Response(
     *     response="200",
     *     description="Products at Category",
     *     @OA\JsonContent(ref="#/components/schemas/ProductCategoryDataView")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionProduct($id)
    {
        $category = Category::findOne($id);
        if(!$category){
            throw new NotFoundHttpException();
        }
        $products = $category->getProducts();
        $productDataView = new ProductCategoryDataView($products->all());
        return $this->renderJson($productDataView->data());

    }
    /**
     * @OA\Post(
     *   path="/api/category",
     *   tags={"Category"},
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/CreateCategoryForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Category create",
     *     @OA\JsonContent(ref="#/components/schemas/CreateCategoryDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   @OA\Response(
     *     response="401",
     *     description="Unauthorized Error",
     *     @OA\JsonContent(ref="#/components/schemas/unauthorized_error")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionCreate()
    {
        $categoryForm = new CreateCategoryForm();
        $categoryForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if($categoryForm->validate())
        {
            $createCategoryService = new CreateCategoryService();
            $category = $createCategoryService->create($categoryForm);
            $dataView = new CreateCategoryDataView($category);
            return $this->renderJson($dataView->categoryCreateResponse());
        }
        return $this->renderJson($categoryForm->getFirstErrors());
    }

    /**
     * @OA\Put(
     *   path="/api/category/{id}",
     *   tags={"Category"},
     *     @OA\Parameter(
     *         description="Category id to update",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/UpdateCategoryForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Category update",
     *     @OA\JsonContent(ref="#/components/schemas/UpdateCategoryDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionUpdate($id)
    {
        $category = Category::findOne($id);
        if(!$category){
            throw new NotFoundHttpException();
        }
        $categoryForm = new UpdateCategoryForm();
        $categoryForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if($categoryForm->validate())
        {
            $updateCategoryService = new UpdateCategoryService();
            $updateCategoryService->update($category, $categoryForm);
            $dataView = new UpdateCategoryDataView($category);
            return $this->renderJson($dataView->categoryUpdateResponse());
        }
        return $this->renderJson($categoryForm->getFirstErrors());
    }

    /**
     * @OA\Delete(
     *   path="/api/category/{id}",
     *   tags={"Category"},
     *     @OA\Parameter(
     *         description="Category id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *   @OA\Response(
     *     response="200",
     *     description="Category delete",
     *     @OA\JsonContent(ref="#/components/schemas/DeleteCategoryDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionDelete($id)
    {
        $category = Category::findOne($id);
        if(!$category){
            throw new NotFoundHttpException();
        }
        $category->delete();
        $dataView = new DeleteCategoryDataView($category);
        return $this->renderJson($dataView->data());
    }

    /**
     * @OA\Post(
     *   path="/api/option_add",
     *   tags={"Category"},
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/OptionAddForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Category create",
     *     @OA\JsonContent(ref="#/components/schemas/OptionAddDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionOptionAdd()
    {
        $categoryOptionForm = new OptionAddForm();
        $categoryOptionForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if($categoryOptionForm->validate())
        {
            $optionAddService = new OptionAddService();
            $categoryOption = $optionAddService->add($categoryOptionForm);
            $dataView = new OptionAddDataView($categoryOption);
            return $this->renderJson($dataView->optionAddResponse());
        }
        return $this->renderJson($categoryOptionForm->getFirstErrors());
    }

    /**
     * @OA\Post(
     *   path="/api/option_update",
     *   tags={"Category"},
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/UpdateCategoryOptionForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="CategoryOption update",
     *     @OA\JsonContent(ref="#/components/schemas/UpdateCategoryOptionDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionOptionUpdate()
    {
        $categoryOptionForm = new UpdateCategoryOptionForm();
        $categoryOptionForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if($categoryOptionForm->validate()){
            $updateCategoryOptionService = new UpdateCategoryOptionService();
            $categoryOption = $updateCategoryOptionService->update($categoryOptionForm);
            $dataView = new UpdateCategoryOptionDataView($categoryOption);
            return $this->renderJson($dataView->categoryUpdateResponse());
        }
        return $this->renderJson($categoryOptionForm->getFirstErrors());
    }

    /**
     * @OA\Delete(
     *   path="/api/option_delete",
     *   tags={"Category"},
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/DeleteCategoryOptionForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="CategoryOption delete",
     *     @OA\JsonContent(ref="#/components/schemas/DeleteCategoryOptionDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionOptionDelete()
    {
        $categoryOptionForm = new DeleteCategoryOptionForm();
        $categoryOptionForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if($categoryOptionForm->validate()){
            $deleteCategoryOptionService = new DeleteCategoryOptionService();
            $deleteCategoryOptionService->delete($categoryOptionForm);
            $dataView = new DeleteCategoryOptionDataView($categoryOptionForm);
            return $this->renderJson($dataView->categoryOptionDeleteResponse());
        }
        return $this->renderJson($categoryOptionForm->getFirstErrors());
    }

    protected function renderJson($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}