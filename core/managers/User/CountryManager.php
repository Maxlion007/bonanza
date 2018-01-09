<?php

namespace core\managers\User;

use core\repositories\User\CountryRepository;
use core\managers\ObjectManager;
class CountryManager extends ObjectManager
{
    private $repository;
    public function __construct(
        CountryRepository $repository
    )
    {
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }
}