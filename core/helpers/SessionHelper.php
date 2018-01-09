<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.10.2017
 * Time: 14:07
 */

namespace core\helpers;
use SebastianBergmann\GlobalState\RuntimeException;
use Yii;

class SessionHelper
{
    const LAST_PROVIDER='last_browsed_provider';
    const LAST_PATIENT='last_browsed_patient';
    const LAST_SUBJECT_TYPE='last_browsed_subject';

    private static function checkSession()
    {
        if(Yii::$app->session->isActive)
        {
            return Yii::$app->session;
        }
        else
        {
            throw new RuntimeException('No active session found.');
        }
    }

    public static function getLastBrowsedType()
    {
        $session=static::checkSession();
        if($type=$session->get(static::LAST_SUBJECT_TYPE))
        {
            return $type;
        }
        else
        {
            throw new \DomainException('No last subject type is set in this session.');
        }
    }

    public static function getLastBrowsedProvider()
    {
        $session=static::checkSession();
        if($provider_id=$session->get(static::LAST_PROVIDER))
        {
         return $provider_id;
        }
        else
        {
            throw new \DomainException('No providers were browsed in this session.');
        }
    }

    public static function getLastBrowsedPatient()
    {
        $session=static::checkSession();
        if($patient_id=$session->get(static::LAST_PATIENT))
        {
            return $patient_id;
        }
        else
        {
            throw new \DomainException('No providers were browsed in this session.');
        }
    }

    public static function saveLastBrowsedProvider($id)
    {
        $session=static::checkSession();
        $session->set(static::LAST_SUBJECT_TYPE,'provider');
        $session->set(static::LAST_PROVIDER,$id);
    }

    public static function saveLastBrowsedPatient($id)
    {
        $session=static::checkSession();
        $session->set(static::LAST_SUBJECT_TYPE,'patient');
        $session->set(static::LAST_PATIENT,$id);
    }

    public static function unsetLastBrowsed()
    {
        $session=static::checkSession();
        unset($_SESSION[static::LAST_SUBJECT_TYPE]);
    }

    public static function unsetLastBrowsedPatient()
    {
        $session=static::checkSession();
        unset($_SESSION[static::LAST_PATIENT]);
    }

    public static function unsetLastBrowsedProvider()
    {
        $session=static::checkSession();
        unset($_SESSION[static::LAST_PROVIDER]);
    }

}