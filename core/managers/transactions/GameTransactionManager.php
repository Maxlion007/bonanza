<?php

namespace core\managers\transactions;

use core\entities\transactions\GameTransaction;
use core\managers\User\UserManager;
use core\repositories\transactions\GameTransactionRepository;
use core\managers\ObjectManager;
use core\services\DbTransactionManager;
use core\managers\infrastructure\TableManager;
use core\forms\transactions\GameTransactionForm;
class GameTransactionManager extends ObjectManager
{
    private $userManager;
    private $repository;
    private $dbTransaction;
    private $tableManager;

    public function __construct(
        GameTransactionRepository $repository,
        TableManager $tableManager,
        UserManager $userManager,
        DbTransactionManager $dbTransaction
    )
    {
        $this->tableManager=$tableManager;
        $this->dbTransaction=$dbTransaction;
        $this->userManager=$userManager;
        $this->repository = $repository;
        return parent::__construct($this->repository);
    }

    public function create($form): GameTransaction
    {
        $subject=new $this->repository->subjectClass();
        $subject = $subject::create($form);
        $this->dbTransaction->wrap(function() use ($form,$subject) {
        $this->repository->save($subject);
        $this->userManager->changeBalance($subject->user_id, -$form->amount);
        $this->tableManager->changeBank($subject->table_id, $form->amount);
        });
        return $subject;
    }

    public function quickCreate(int $user_id,int $table_id,int $amount)
    {
        $form=new GameTransactionForm();
        $form->user_id=$user_id;
        $form->table_id=$table_id;
        $form->amount=$amount;
        $this->create($form);
    }
//    public function edit($id, $form)
//    {
//        $subject=$this->repository->get($id);
//
//        $this->dbTransaction->wrap(function() use ($form,$subject) {
//        $old_value=$subject->amount;
//        $subject->edit($form);
//        $this->userManager->changeBalance($subject->user_id, -($form->amount-$old_value));
//        $this->tableManager->changeBank($subject->table_id, $form->amount-$old_value);
//        $this->repository->save($subject);
//        });
//    }

    public function remove($id)
    {
        $subject = $this->repository->get($id);
        $this->dbTransaction->wrap(function() use ($subject) {
            $this->userManager->changeBalance($subject->user_id, $subject->amount);
            $this->tableManager->changeBank($subject->table_id, -$subject->amount);
            $this->repository->remove($subject);
        });
    }
}