<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 10.10.2017
 * Time: 18:06
 */

namespace core\helpers;


class DateHelper
{

    public static function convertDate($string)
    {
        $monthes = ['January','February','March','April','May','June','July','August','September','October','November','Devember'];
        $day=gmdate("d", $string);
        $month=$monthes[gmdate("m", $string)];
        $year=gmdate("Y", $string);
        return "$day $month $year";
    }
}