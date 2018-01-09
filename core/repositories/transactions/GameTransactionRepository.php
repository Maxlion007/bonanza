<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\transactions;

use core\entities\transactions\GameTransaction;
use core\repositories\ObjectRepository;

class GameTransactionRepository extends ObjectRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=GameTransaction::className();
        return parent::__construct($this->subjectClass);
    }
}