<?php


namespace app\modules\api\controllers;


use app\models\Product;
use app\modules\api\dataView\product\CreateProductDataView;
use app\modules\api\dataView\product\DeleteProductDataView;
use app\modules\api\dataView\product\IndexProductDataView;
use app\modules\api\dataView\product\UpdateProductDataView;
use app\modules\api\forms\product\CreateProductForm;
use app\modules\api\forms\product\UpdateProductForm;
use app\modules\api\services\product\CreateProductService;
use app\modules\api\services\product\UpdateProductService;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;
use yii\web\Controller;

class ProductController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class
        ];

        return $behaviors;
    }

    /**
     * @OA\Get(
     *   path="/api/product",
     *   tags={"Product"},
     *   @OA\Response(
     *     response="200",
     *     description="Product",
     *     @OA\JsonContent(ref="#/components/schemas/IndexProductDataView")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionIndex()
    {
        $products = Product::find()->all();
        $indexDataView = new IndexProductDataView($products);
        return $this->renderJson($indexDataView->data());
    }

    /**
     * @OA\Post(
     *   path="/api/product",
     *   tags={"Product"},
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/CreateProductForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Product create",
     *     @OA\JsonContent(ref="#/components/schemas/CreateProductDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *     security={{
     *    "api_key":{}
     *     }}
     * )
     */

    public function actionCreate()
    {
        $productForm = new CreateProductForm();
        $productForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if($productForm->validate())
        {
            $createProductService = new CreateProductService();
            $product = $createProductService->create($productForm);
            $dataView = new CreateProductDataView($product);
            return $this->renderJson($dataView->productCreateResponse());
        }
        return $this->renderJson($productForm->getFirstErrors());
    }

    /**
     * @OA\Put(
     *   path="/api/product/{id}",
     *   tags={"Product"},
     *     @OA\Parameter(
     *         description="Product id to update",
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
     *       @OA\Schema(ref="#/components/schemas/UpdateProductForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Product update",
     *     @OA\JsonContent(ref="#/components/schemas/UpdateProductDataView")
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
        $product = Product::findOne($id);
        if(!$product)
        {
            throw new NotFoundHttpException();
        }
        $productForm = new UpdateProductForm();
        $productForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if($productForm->validate())
        {
            $updateProductService = new UpdateProductService();
            $updateProductService->update($product, $productForm);
            $dataView = new UpdateProductDataView($product);
            return $this->renderJson($dataView->productUpdateResponse());
        }
        return $this->renderJson($productForm->getFirstErrors());
    }

    /**
     * @OA\Delete(
     *   path="/api/product/{id}",
     *   tags={"Product"},
     *     @OA\Parameter(
     *         description="Product id to delete",
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
     *     @OA\JsonContent(ref="#/components/schemas/DeleteProductDataView")
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   @OA\Response(
     *     response="401",
     *     description="Authorization Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   ),
     *   security={{
     *     "api_key":{}
     *   }}
     * )
     */

    public function actionDelete($id)
    {
        $product = Product::findOne($id);
        if(!$product){
            throw new NotFoundHttpException();
        }
        $product->delete();
        $dataView = new DeleteProductDataView($product);
        return $this->renderJson($dataView->data());
    }

    protected function renderJson($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}