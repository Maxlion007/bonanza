<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 07.09.2017
 * Time: 21:41
 */

namespace core\services\auth;
use Yii;
use core\repositories\User\UserRepository;
use core\entities\User\User;
use yii\mail\MailerInterface;
use core\services\DbTransactionManager;
use core\access\Rbac;

class SignupService
{

    private $users;
    private $transaction;
    public function __construct($adminEmail, MailerInterface $mailer, UserRepository $users, DbTransactionManager $transaction)
    {
        $this->users=$users;
        $this->transaction=$transaction;
        //      $this->supportEmail=$supportEmail;
        $this->mailer=$mailer;
    }

    public function signup($form)
    {
        $user =User::requestSignup($form);

        if(User::find()->andWhere(['username'=>$form->username])->one())
        {
            throw new \DomainException('Username already exists');
        }

        if(User::find()->andWhere(['email'=>$form->email])->one())
        {
            throw new \DomainException('Email already exists');
        }

        $this->transaction->wrap(function() use ($user,$form)
        {
            $this->users->save($user);
            $sent = Yii::$app->mailer->compose(['html'=>'emailConfirmToken-html','text'=>'emailConfirmToken-text'],
                ['user'=>$user])->setTo($form->email)->setSubject('Signup confirm for '.Yii::$app->name)
                ->send();
                return ($sent==true) ? $user : false;
        });

//        return $user;
    }

    public function confirm($token)
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        if(!$user)
        {
            throw new \DomainException('User is not found');
        }
        $user->confirmSignup();
        $this->users->save($user);

//        $user->save($user);
//        return $user;
    }
}