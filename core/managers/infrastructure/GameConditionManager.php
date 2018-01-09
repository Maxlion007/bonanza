<?php

namespace core\managers\infrastructure;

use core\repositories\infrastructure\GameConditionRepository;
use core\managers\ObjectManager;
class GameConditionManager extends ObjectManager
{
    private $repository;
    public function __construct(
        GameConditionRepository $repository
    )
    {
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }

    public function create($form)
    {

        $subject=new $this->repository->subjectClass();
        $subject = $subject::create($form);
//        var_dump($subject);
//        die('123123123');
        $this->repository->save($subject);
        return $subject;
    }

    public function edit($id, $form)
    {
        $subject=$this->repository->get($id);
        $subject->edit($form);
        $this->repository->save($subject);
    }


}