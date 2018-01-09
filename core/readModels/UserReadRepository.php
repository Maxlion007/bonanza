<?php

namespace core\readModels;

use core\entities\User\User;

class UserReadRepository
{
    public function find($id)
    {
        return User::findOne($id);
    }

    public function findActiveByUsername($username)
    {
        return User::findOne(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    public function findActiveById($id)
    {
        return User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }
}