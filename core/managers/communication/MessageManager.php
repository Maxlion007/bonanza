<?php

namespace core\managers\communication;

use core\repositories\communication\MessageRepository;
use core\managers\ObjectManager;
class MessageManager extends ObjectManager
{
    private $repository;
    public function __construct(
        MessageRepository $repository
    )
    {
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }
}