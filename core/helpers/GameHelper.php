<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.12.2017
 * Time: 13:00
 */

namespace core\helpers;


class GameHelper
{

    const GAME_FOOL='fool';
    const GAME_POKER='poker';
    const GAME_SEKA='seka';

    public static function gamesList()
    {
        return [static::GAME_FOOL,static::GAME_POKER,static::GAME_SEKA];
    }

    public static function checkGameName($game_name)
    {
        if(!in_array($game_name,static::gamesList()))
        {
            throw new \RuntimeException('Unknow game type.');
        }
        return true;
    }
}