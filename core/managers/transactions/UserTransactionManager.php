<?php

namespace core\managers\transactions;

use core\managers\User\UserManager;
use core\repositories\transactions\UserTransactionRepository;
use core\managers\ObjectManager;
use core\services\DbTransactionManager;

class UserTransactionManager extends ObjectManager
{
    private $userManager;
    private $repository;
    private $dbTransaction;

    public function __construct(
        UserTransactionRepository $repository,
        UserManager $userManager,
        DbTransactionManager $dbTransaction
    )
    {
        $this->dbTransaction=$dbTransaction;
        $this->userManager=$userManager;
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }

    public function create($form)
    {
        $subject=new $this->repository->subjectClass();
        $subject = $subject::create($form);
        $this->dbTransaction->wrap(function() use ($form,$subject) {
            $this->repository->save($subject);
            $this->userManager->changeBalance($subject->sender_id, -$form->amount);
            $this->userManager->changeBalance($subject->receiver_id, $form->amount);
        });
        return $subject;
    }

//    public function edit($id, $form)
//    {
//        $subject=$this->repository->get($id);
//
//        $this->dbTransaction->wrap(function() use ($form,$subject) {
//            $old_value=$subject->amount;
//            $subject->edit($form);
//            $this->userManager->changeBalance($subject->sender_id, -($form->amount-$old_value));
//            $this->userManager->changeBalance($subject->receiver_id, $form->amount-$old_value);
//            $this->repository->save($subject);
//        });
//
//    }

    public function remove($id)
    {
        $subject = $this->repository->get($id);
        $this->dbTransaction->wrap(function() use ($subject) {
            $this->userManager->changeBalance($subject->sender_id, $subject->amount);
            $this->userManager->changeBalance($subject->receiver_id, -$subject->amount);
            $this->repository->remove($subject);
        });

    }

}