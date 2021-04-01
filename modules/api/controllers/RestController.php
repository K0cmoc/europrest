<?php

namespace app\modules\api\controllers;

use app\modules\api\forms\rest\LoginForm;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class RestController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
            ],
        ];

        return $behaviors;
    }

    /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"Rest"},
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/LoginForm"),
     *     ),
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Validation Error",
     *     @OA\JsonContent(ref="#/components/schemas/response_client_errors")
     *   )
     * )
     */

    public function actionLogin()
    {

        $loginForm = new LoginForm();
        $loginForm->load(json_decode(Yii::$app->request->getRawBody(), true));
        if(!$loginForm->validate())
        {
            return $this->renderJson($loginForm->getFirstErrors());
        }
        $user = $loginForm->getUser();

        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();

        $token = $jwt->getBuilder()
            ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 3600)// Configures the expiration time of the token (exp claim)
            ->withClaim('id', $user->id)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token
        return $this->asJson([
            'token' => 'Bearer ' . (string)$token,
        ]);
    }

    /**
     * @return \yii\web\Response
     */
    protected function renderJson($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}