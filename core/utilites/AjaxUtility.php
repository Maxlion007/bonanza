<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.10.2017
 * Time: 14:47
 */

namespace core\utilites;


use yii\db\Exception;
use yii\helpers\Html;

class AjaxUtility
{

    public static function ajaxCreateResponse(array $result, $tag='select',$subject='provider')
    {
        $response='';
        if(!$tag)
        {
            throw new Exception('No tag is selected');
        }

        switch($subject)
        {
            case 'provider':
                $result=static::prepareProviderData($result,$tag);
                $response=static::formatTag($result,$tag);
                break;
            case 'patient':
                $result=static::preparePatientData($result,$tag);
                $response=static::formatTag($result,$tag);
                break;
        }
        die($response);
    }

    public static function prepareUserData(array $result):array
    {
        $prepared_data=[];
        foreach($result as $data)
        {

            $prepared_data[$data->id]=$data->username.' ('.$data->fullname.')';
        }
        return $prepared_data;
    }

    public static function formatTag(array $result):array
    {
        $text='';

                foreach($result as $element)
                {
                    $text.="<li class='suggestion'>$element</li>";
                }

                $text.="</ul>";
        return $text;
    }

}