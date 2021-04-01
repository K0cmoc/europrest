<?php

/**
 * RESPONSES
 *
 * @OA\Schema(
 *   schema="response_not_found",
 *   description="Not found response",
 *   type="object",
 *   title="Not found response",
 *   @OA\Property(property="name", type="string", example="Not Found"),
 *   @OA\Property(property="message", type="string", example="Resource is not found"),
 *   @OA\Property(property="code", type="integer", example=0),
 *   @OA\Property(property="status", type="integer", example=404),
 *   @OA\Property(property="type", type="string", example="yii\web\NotFoundHttpException"),
 * )
 *
 * @OA\Schema(
 *   schema="unauthorized_error",
 *   description="Unauthorized error",
 *   type="object",
 *   title="User unauthorize",
 *   @OA\Property(property="name", type="string", example="Unauthorize"),
 *   @OA\Property(property="message", type="string", example="User is unauthorized"),
 *   @OA\Property(property="code", type="integer", example=0),
 *   @OA\Property(property="status", type="integer", example=401),
 *   @OA\Property(property="type", type="string", example="yii\web\UnauthorizedHttpException"),
 * )
 *
 * @OA\Schema(
 *   schema="response_client_errors",
 *   description="Client errors response",
 *   type="object",
 *   title="Client errors response",
 *   @OA\Property(property="name", type="string", example="Unprocessable entity"),
 *   @OA\Property(property="message", type="string", example=""),
 *   @OA\Property(property="code", type="integer", example=0),
 *   @OA\Property(property="status", type="integer", example=422),
 *   @OA\Property(property="type", type="string", example="api\exceptions\ClientErrorsHttpException"),
 *   @OA\Property(
 *     property="errors",
 *     type="object",
 *     @OA\Items(
 *       @OA\AdditionalProperties(
 *         type="string",
 *       ),
 *     ),
 *     example={"field1": "error1", "field2": "error2"},
 *   ),
 * )
 *
 * @OA\SecurityScheme(
 *   securityScheme="api_key",
 *   type="apiKey",
 *   in="header",
 *   name="Authorization"
 * )
 */