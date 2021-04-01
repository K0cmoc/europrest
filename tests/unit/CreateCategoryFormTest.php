<?php


namespace tests\unit;


use app\models\CategoryOption;
use app\modules\api\forms\category\CreateCategoryForm;
use Codeception\Specify;
use Codeception\Test\Unit;

class CreateCategoryFormTest extends Unit
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
                'categoryOptions' => [
                    [
                        'name' => \Yii::$app->security->generateRandomString()
                    ],
                    [
                        'name' => \Yii::$app->security->generateRandomString()
                    ]
                ]
            ];
            $createCategoryForm = new CreateCategoryForm();
            $createCategoryForm->load($data);
            verify($createCategoryForm->name)->equals($data['name']);
            foreach ($data['categoryOptions'] as $option){
                $optionId = $this->tester->haveRecord(CategoryOption::class, [
                    'name' => $option['name']
                ]);
                verify(CategoryOption::findOne($optionId)->name)->equals($option['name']);
            }
        });
    }

    public function testSuccessValidate()
    {
        $this->specify('It should success validate new data', function () {
            $data = [
                'name' => \Yii::$app->security->generateRandomString(),
                'categoryOptions' => [
                    [
                        'name' => \Yii::$app->security->generateRandomString()
                    ]
                ]
            ];

            $createCategoryForm = new CreateCategoryForm();
            $createCategoryForm->load($data);

            verify($createCategoryForm->validate())->equals(true);
            verify($createCategoryForm->getFirstErrors())->equals([]);
        });
    }

    public function testValidationRequiredErrors()
    {
        $this->specify('It should have validation errors on required fields', function () {
            $data = [
                'name' => ''
            ];

            $createCategoryForm = new CreateCategoryForm();
            $createCategoryForm->load($data);

            verify($createCategoryForm->validate())->equals(false);
            verify(array_keys($createCategoryForm->getFirstErrors()))->equals(['name']);
        });
    }
}