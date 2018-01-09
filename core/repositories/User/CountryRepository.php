<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\User;
use core\entities\User\Country;
use core\repositories\ObjectRepository;
class CountryRepository extends ObjectRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=Country::className();
        return parent::__construct($this->subjectClass);
    }
}