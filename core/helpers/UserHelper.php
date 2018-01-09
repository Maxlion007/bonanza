<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21.09.2017
 * Time: 13:14
 */

namespace core\helpers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use core\entities\User\User;
use Yii;
use core\repositories\User\UserRepository;

class UserHelper
{

    public static function prepareUsernamesList($suspended=false)
    {
        $repository=Yii::$container->get(UserRepository::class);

        if($suspended)
        {
            $users=$repository->getActive();
        }
        else
        {
            $users=$repository->getActiveAndNotSuspended();
        }

        return ArrayHelper::map($users,'id','username');
    }

    public static function prepareFullnamesList($suspended=false)
    {
        $repository=Yii::$container->get(UserRepository::class);

        if($suspended)
        {
            $users=$repository->getActive();
        }
        else
        {
            $users=$repository->getActiveAndNotSuspended();
        }

        return ArrayHelper::map($users,'id','fullname');
    }

    public static function prepareBothNamesList($suspended=false)
    {
        $repository=Yii::$container->get(UserRepository::class);
        $result=[];
        if($suspended)
        {
            $users=$repository->getActive();
        }
        else
        {
            $users=$repository->getActiveAndNotSuspended();
        }

        foreach($users as $user)
        {
            $result[$user->id]=$user->username.' ('.$user->fullname.')';
        };
        return $result;
    }
    public static function genderList()
    {
        return [0=>'Male',1=>'Female'];
//        return [0=>'Undefined',1=>'Male',2=>'Female'];
    }
    public static function statusList()
    {
        return [
            User::STATUS_WAIT=>'Wait',
            User::STATUS_ACTIVE => 'Active'
        ];
    }
    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(),$status);
    }

    public static function statusLabel($status)
    {
        switch($status)
        {
            case User::STATUS_WAIT;
            $class='label label-default';
            break;
            case User::STATUS_ACTIVE;
            $class="label label-success";
            break;
            default:
            $class="label label-default";
        }
        return Html::tag('span',ArrayHelper::getValue(self::statusList(),$status),['class'=>$class]);
    }

    public static function genderName($code)
    {
        return static::genderList()[$code];
    }

}