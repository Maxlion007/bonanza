<?php
namespace core\forms\auth;

use yii\base\Model;
use core\entities\User\User;

/**
 * Signup form
 */
class SignupFormOld extends Model
{
    public $username;
    public $fullname;
    public $email;
    public $phone;
    public $gender;
    public $birthday;
    public $country;
    public $about;
    public $avatar;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'min' => 6, 'max' => 18],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
}
