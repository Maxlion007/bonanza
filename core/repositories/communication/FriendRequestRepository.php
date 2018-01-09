<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\communication;
use Exception;
use core\entities\communication\FriendRequest;

class FriendRequestRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=FriendRequest::className();
//        return parent::__construct($this->subjectClass);
    }

    public function get($sender_id, $receiver_id)
    {
        $subject = new $this->subjectClass();
        return $subject::find()->where(['sender_id'=>$sender_id])->andWhere(['receiver_id'=>$receiver_id])->limit(1)->one();
    }
    public function save($subject)
    {
        try{
            if (!$subject->save()) {
                throw new \DomainException('Saving error.');
            }
        }catch(Exception $e)
        {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }
        return true;
    }

    public function remove($subject)
    {
        try{
            if (!$subject->delete()) {
                throw new \RuntimeException('Deletion error.');
            }
        }catch(Exception $e)
        {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }
        return true;
    }
}