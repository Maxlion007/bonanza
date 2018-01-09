<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.11.2017
 * Time: 0:16
 */

namespace core\helpers;


class ZipcodeCoordinatesHelper
{

    public static function formatCoordinates($raw)
    {
        $error=false;
        $result=[];
        $raw=explode(',0.0',$raw);
        foreach($raw as $coords)
        {
            $coords=explode(',',$coords);
            if($coords[0]!='')
            {
                if(static::checkGeographicalIntegrity($coords))
                {
                    $result[]=['latitude'=>trim($coords[1]),'longitude'=>trim($coords[0])];
                }
                else
                {
                    $error=true;
                }
            }
        }
        return $result;
    }

    public static function checkGeographicalIntegrity($coordinates)
    {
        if(count($coordinates)==2)
        {
            if(trim($coordinates[0])!=false && trim($coordinates[1])!=false)
            {
                if(strpos($coordinates[0],'-')!==false)
                {
                    return true;
                }
//                else
//                {
//                    echo "longitude is weird";
//                }

            }
//            else
//            {
//                echo "coordinate is empty";
//            }
        }
//        else
//        {
//            echo "count is not 2";
//        }

        return false;
    }
}