<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\infrastructure;
use core\entities\infrastructure\Table;
use core\repositories\ObjectRepository;
class TableRepository extends ObjectRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=Table::className();
        return parent::__construct($this->subjectClass);
    }

//    public function getTablesAndTournaments()
//    {
//
//        $tables=Table::find()->asArray()->all();
//        $tournaments=Tournament::find()->asArray()->all();
//    }
}