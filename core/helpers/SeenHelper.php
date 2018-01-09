<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.12.2017
 * Time: 14:10
 */

namespace core\helpers;


class SeenHelper
{

    const UNSEEN=0;
    const SEEN=1;

    public static function statusList()
    {
        return [static::UNSEEN=>'Not seen',static::SEEN=>'Seen'];
    }
}