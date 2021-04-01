<?php


namespace unit;


use app\models\CategoryOption;
use app\modules\api\forms\category\UpdateCategoryOptionForm;
use Codeception\Specify;
use Codeception\Test\Unit;

class UpdateCategoryOptionFormTest extends Unit
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
                'name' => \Yii::$app->security->generateRandomString()
            ];

            $optionUpdateForm = new UpdateCategoryOptionForm();
            $optionUpdateForm->load($data);
            verify($optionUpdateForm->name)->equals($data['name']);
        });
    }

    public function testSuccessValidate()
    {
        $this->specify('It should success validate new data', function () {
            $categoryOptionId = $this->tester->haveRecord(CategoryOption::class, [
                'name' => \Yii::$app->security->generateRandomString()
            ]);
            $data = [
                'id' => $categoryOptionId,
                'name' => \Yii::$app->security->generateRandomString()
            ];

            $optionUpdateForm = new UpdateCategoryOptionForm();
            $optionUpdateForm->load($data);

            verify($optionUpdateForm->validate())->equals(true);
            verify($optionUpdateForm->getFirstErrors())->equals([]);
        });
    }

    public function testValidationRequiredErrors()
    {
        $this->specify('It should have validation errors on required fields', function () {
            $data = [
                'id' => null,
                'name' => ''
            ];

            $optionUpdateForm = new UpdateCategoryOptionForm();
            $optionUpdateForm->load($data);

            verify($optionUpdateForm->validate())->equals(false);
            verify(array_keys($optionUpdateForm->getFirstErrors()))->equals(['id', 'name']);
        });
    }
}