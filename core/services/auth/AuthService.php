<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 14.09.2017
 * Time: 19:12
 */

namespace core\services\auth;

use Yii;
use core\entities\User\User;
use core\forms\auth\LoginForm;
use core\repositories\User\UserRepository;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users=$users;
    }

    public function auth(LoginForm $form)
    {
        $user=$this->users->getByUsername($form->username);
        if(!$user || !$user->isActive() || !$user->validatePassword($form->password))
        {
            throw new \DomainException('Undefined user or password.');
        }

    return $user;
    }
}