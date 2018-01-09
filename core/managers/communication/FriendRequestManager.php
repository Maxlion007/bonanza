<?php

namespace core\managers\communication;

use core\entities\communication\FriendRequest;
use core\repositories\communication\FriendRequestRepository;
use core\managers\ObjectManager;
use yii\db\Exception;

class FriendRequestManager
{
    private $repository;
    public function __construct(
        FriendRequestRepository $repository
    )
    {
        $this->repository = $repository;
//        return parent::__construct($this->repository);
    }

    public function create($model)
    {
        $subject=new $this->repository->subjectClass();
        $subject = $subject::create($model->sender_id,$model->receiver_id,$model->status);
        $this->repository->save($subject);
        return $subject;
    }

    public function edit($sender_id,$receiver_id,$status)
    {
        $subject=$this->repository->get($sender_id,$receiver_id);
        $subject->edit($status);
        $this->repository->save($subject);
    }

    public function remove($sender_id,$receiver_id)
    {
        $subject=$this->repository->get($sender_id,$receiver_id);
        $this->repository->remove($subject);
    }

    public function accept($sender_id,$receiver_id)
    {
        $this->edit($sender_id,$receiver_id,FriendRequest::ACCEPTED);
    }

    public function reject($sender_id,$receiver_id)
    {
        $this->edit($sender_id,$receiver_id,FriendRequest::REJECTED);
    }
}