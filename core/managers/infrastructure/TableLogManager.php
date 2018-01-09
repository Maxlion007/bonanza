<?php

namespace core\managers\infrastructure;

use core\repositories\infrastructure\TableLogRepository;
use core\managers\ObjectManager;
class TableLogManager extends ObjectManager
{

    private $repository;

    public function __construct(
        TableLogRepository $repository
    )
    {
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }
}