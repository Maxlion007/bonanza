<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 14.09.2017
 * Time: 18:50
 */

namespace core\repositories\User;

use core\entities\User\UserSuspension;
use core\repositories\ObjectRepository;
use core\entities\User\User;
use yii\db\Exception;
use core\entities\transactions\UserTransaction;
    class UserRepository extends ObjectRepository
{

    public function __construct()
    {
        parent::__construct(User::className());
    }

        public function getByEmailConfirmToken($token)
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    public function getByEmail($email)
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByUsername($username)
    {
        return $this->getBy(['username' => $username]);
    }

    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }

    public function getByPasswordResetToken($token)
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken($token)
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function save($user)
    {
        try{
            if (!$user->save()) {
                throw new \DomainException('Saving error.');
            }
        }catch(Exception $e)
        {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }

        return true;
    }

    public function findByUsernameOrFullname($keyword)
    {
        return User::find()->where(['like','username',$keyword])->orWhere(['like','fullname',$keyword])->all();
    }

    public function findByUsernameOrEmail($username)
    {
        return $this->getBy(['username' => $username]);
    }

    public function findByNetworkIdentity($network,$identity)
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    public function findPendingUsers()
    {
        return $this->getAll(['status' => User::STATUS_WAIT]);
    }

        public function getActive()
        {
            return $this->getAll(['status' => User::STATUS_ACTIVE]);
        }


    public function getActiveAndNotSuspended()
    {
        return User::find()->where([User::tableName().'.status' => User::STATUS_ACTIVE])
            ->join('LEFT JOIN', UserSuspension::tableName(), UserSuspension::tableName().'.user_id = '.User::tableName().'.id')
            ->andWhere(UserSuspension::tableName().'.datetime_end <="'.date('Y-m-d H:i:s').'"')
            ->orWhere(UserSuspension::tableName().'.id is NULL')
            ->all();
    }

    //    public function getAllBy(array $condition) {
//        $query = User::find();
//        if (!$users = User::find()->andWhere($condition)->all()) {
//            throw new \DomainException('User not found');
//        }
//        return $users;
//    }

    public function getBy(array $condition)
    {

        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new \RuntimeException('User not found');
        }
        return $user;
    }
}
