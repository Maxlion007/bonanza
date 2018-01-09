<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 10.09.2017
 * Time: 19:55
 */

namespace core\services\auth;

use Yii;
use core\entities\User\User;
use yii\mail\MailerInterface;
use core\repositories\UserRepository;

class PasswordResetService
{

    private $mailer;

    private $users;
    public function __construct(MailerInterface $mailer,UserRepository $users)
    {
        $this->mailer=$mailer;
        $this->users=$users;
    }

    public function request($form)
    {
        $user = $this->users->getByEmail($form->email);

        if (!$user) {
            throw new \RuntimeException(
                'User not found.'
            );
        }

        $user->requestPasswordReset();

        $this->users->save($user);

        if(!$this
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
//            ->setFrom($this->supportEmail)
            ->setTo($form->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send())
        {
            throw new \DomainException(
                'Could not send password resent mail.'
            );
        }
        return true;
    }
    public function reset($token,$form)
    {
    $user = $this->users->getByPasswordResetToken($token);

    if(!$user)
    {
     throw new \DomainException('User not found');
    }

    $user->resetPassword($form->password);

    $this->users->save($user);
    }


    public function validateToken($token)
    {
        if(empty($token) || !is_string($token))
        {
            throw new \Exception('Password reset token cannot be blank.');
        }

        if(!$this->users->getByPasswordResetToken($token))
        {
            throw new \Exception('Wrong password reset token.');
        }
    }
//    public static function sendEmail($form)
//    {
//        /* @var $user User */
//        $user = User::findOne([
//            'status' => User::STATUS_ACTIVE,
//            'email' => $form->email,
//        ]);
//
//        if (!$user) {
//            throw new \RuntimeException(
//                'User not found.'
//            );
//        }
//
//
//        if(!Yii::$app
//            ->mailer
//            ->compose(
//                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
//                ['user' => $user]
//            )
//            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
//            ->setTo($form->email)
//            ->setSubject('Password reset for ' . Yii::$app->name)
//            ->send())
//        {
//            throw new \DomainException(
//                'Could not send password reset mail.'
//            );
//        }
//        return true;
//    }

}