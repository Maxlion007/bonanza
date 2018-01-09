<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\infrastructure;
use core\entities\infrastructure\TableLog;
use core\repositories\ObjectRepository;
class TableLogRepository extends ObjectRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=TableLog::className();
        return parent::__construct($this->subjectClass);
    }
}