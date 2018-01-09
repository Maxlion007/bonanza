<?php

namespace core\managers\infrastructure;

use core\repositories\infrastructure\TableRepository;
use core\managers\ObjectManager;
class TableManager extends ObjectManager
{
    private $repository;
    public function __construct(
        TableRepository $repository
    )
    {
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }

    public function create($form)
    {

        $subject=new $this->repository->subjectClass();
        $subject = $subject::create($form);

        foreach ($form->values as $value) {
            $subject->setValue($value->id, $value->value);
        }
        $this->repository->save($subject);
        return $subject;
    }

    public function edit($id, $form)
    {
        $subject=$this->repository->get($id);
        $subject->edit($form);
        foreach ($form->values as $value) {
            $subject->setValue($value->id, $value->value);
        }
        $this->repository->save($subject);
    }

    public function remove($id)
    {
        $subject = $this->repository->get($id);
        $this->repository->remove($subject);
    }

    public function changeBank(int $id,int $amount)
    {
        $table=$this->repository->get($id);
        $table->bank+=$amount;
        $this->repository->save($table);
    }
}