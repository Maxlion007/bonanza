<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\communication;
use core\entities\communication\Message;
use core\repositories\ObjectRepository;
class MessageRepository extends ObjectRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=Message::className();
        return parent::__construct($this->subjectClass);
    }
}