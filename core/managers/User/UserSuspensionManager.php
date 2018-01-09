<?php

namespace core\managers\User;

use core\repositories\User\UserSuspensionRepository;
use core\managers\ObjectManager;
class UserSuspensionManager extends ObjectManager
{
    private $repository;
    public function __construct(
        UserSuspensionRepository $repository
    )
    {
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }
}