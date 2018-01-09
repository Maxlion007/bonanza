<?php

namespace core\managers\infrastructure;

use core\repositories\infrastructure\ConditionValueRepository;
use core\managers\ObjectManager;
class ConditionValueManager extends ObjectManager
{
    private $repository;
    public function __construct(
        ConditionValueRepository $repository
    )
    {
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }
}