<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.11.2017
 * Time: 13:42
 */

namespace core\services\geolocation;


use core\dataManagers\DataManagerInterface;

interface ZipcodeDataManager extends DataManagerInterface
{
    public function fetchZipcodes($state=[]);
}