<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\transactions;

use core\entities\transactions\UserTransaction;
use core\repositories\ObjectRepository;

class UserTransactionRepository extends ObjectRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=UserTransaction::className();
        return parent::__construct($this->subjectClass);
    }
}