<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.10.2017
 * Time: 18:15
 */

namespace core\helpers;


class AddressHelper
{

    public static function formatAddress($address1,$address2='',$city,$administrative_entity,$zip_code)
    {
        //1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA
        return "$address1, $city, $administrative_entity $zip_code, USA";
    }


}