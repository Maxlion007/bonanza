<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.12.2017
 * Time: 20:37
 */

namespace core\helpers;

use yii\helpers\ArrayHelper;
use Yii;
use core\repositories\User\CountryRepository;
class CountryHelper
{
    public static function prepareCountries()
    {
        $countries=ArrayHelper::map(Yii::$container->get(CountryRepository::class)->getAll(),'id','name');
        return $countries;
    }

    public static function countryName($country_id)
    {
        return Yii::$container->get(CountryRepository::class)->get($country_id)->name;
    }
}