<?php

namespace core\managers;

use core\repositories\ObjectRepository;
use yii\base\Model;

class ObjectManager
{
    private $repository;
    public function __construct(
        ObjectRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create($form)
    {
        $subject=new $this->repository->subjectClass();
        $subject = $subject::create($form);
        $this->repository->save($subject);
        return $subject;
    }

    public function edit($id, $form)
    {
        $subject=$this->repository->get($id);
        $subject->edit($form);
        $this->repository->save($subject);
    }

    public function remove($id)
    {
        $subject = $this->repository->get($id);
        $this->repository->remove($subject);
    }
}