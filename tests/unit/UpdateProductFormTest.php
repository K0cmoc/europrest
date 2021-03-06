<?php


namespace unit;


use app\modules\api\forms\product\UpdateProductForm;
use Codeception\Specify;
use Codeception\Test\Unit;

class UpdateProductFormTest extends Unit
{
    use Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testSuccessLoadData()
    {
        $this->specify('It should success load data', function () {
            $data = [
                'name' => \Yii::$app->security->generateRandomString(),
                'description' => \Yii::$app->security->generateRandomString(),
                'price' => rand(),
            ];

            $updateProductForm = new UpdateProductForm();
            $updateProductForm->load($data);
            verify($updateProductForm->name)->equals($data['name']);
            verify($updateProductForm->description)->equals($data['description']);
            verify($updateProductForm->price)->equals($data['price']);
        });
    }

    public function testSuccessValidate()
    {
        $this->specify('It should success validate new data', function () {
            $data = [
                'name' => \Yii::$app->security->generateRandomString(),
                'description' => \Yii::$app->security->generateRandomString(),
                'price' => rand(),
            ];

            $updateProductForm = new UpdateProductForm();
            $updateProductForm->load($data);

            verify($updateProductForm->validate())->equals(true);
            verify($updateProductForm->getFirstErrors())->equals([]);
        });
    }

    public function testValidationRequiredErrors()
    {
        $this->specify('It should have validation errors on required fields', function () {
            $data = [
                'name' => "",
                'description' => "",
                'price' => null,
            ];

            $updateProductForm = new UpdateProductForm();
            $updateProductForm->load($data);

            verify($updateProductForm->validate())->equals(false);
            verify(array_keys($updateProductForm->getFirstErrors()))->equals(['name', 'description', 'price']);
        });
    }
}