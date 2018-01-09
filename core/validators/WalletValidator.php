<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.12.2017
 * Time: 13:06
 */

namespace core\validators;

use Yii;
use core\repositories\User\UserRepository;
class WalletValidator
{

    public static function validate($amount,$sender_id,$sender_type)
    {
        $sender=new $sender_type();

        $balance=$sender::findOne($sender_id)->wallet;

        if($amount<$balance)
        {
            return true;
        }

        return false;
    }
}