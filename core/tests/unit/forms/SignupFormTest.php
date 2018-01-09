<?php
namespace core\tests\unit\forms;

use common\fixtures\UserFixture;
use core\forms\auth\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'phone' => '70000000005',
            'password' => 'some_password',
        ]);

        expect_that($model->validate());
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'phone' => '70000000005',
            'password' => 'some_password',
        ]);

        expect($model->validate());
        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));
        expect_that($model->getErrors('phone'));
        expect($model->getFirstError('username'))
            ->equals('This username has already been taken.');
        expect($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}