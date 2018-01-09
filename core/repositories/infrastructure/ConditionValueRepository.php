<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 29.05.17
 * Time: 15:00
 */

namespace core\repositories\infrastructure;

use core\entities\infrastructure\ConditionValue;
use core\repositories\NotFoundExeption;
use core\repositories\ObjectRepository;
class ConditionValueRepository extends ObjectRepository
{
    public $subjectClass;

    public function __construct()
    {
        $this->subjectClass=ConditionValue::class;
        return parent::__construct($this->subjectClass);
    }
}