<?php

namespace app\modules\api\controllers;

use Yii;

class DocumentationController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionSwagger()
    {
        $basePath = $this->module->getBasePath();

        $openApi = \OpenApi\scan($basePath);

        $response = Yii::$app->response;
        $response->content = $openApi->toJson();

        return $response;
    }
}
