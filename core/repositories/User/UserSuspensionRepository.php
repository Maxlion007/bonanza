<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories\User;

use core\entities\User\UserSuspension;
use core\repositories\ObjectRepository;
class UserSuspensionRepository extends ObjectRepository
{
    public $subjectClass;
    public function __construct()
    {
        $this->subjectClass=UserSuspension::className();
        return parent::__construct($this->subjectClass);
    }

    public function getAllActive()
    {
        $date= date('Y-m-d H:i:s');
        return UserSuspension::find()->where(['<','datetime_end',$date])->all();
    }

    public function getAllExpired()
    {
        $date= date('Y-m-d H:i:s');
        return UserSuspension::find()->where(['>','datetime_end',$date])->all();
    }


}