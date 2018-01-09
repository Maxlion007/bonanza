<?php

namespace core\helpers;

use yii\helpers\ArrayHelper;
use core\entities\User\Characteristic;

class CharacteristicHelper
{
    public static function typeList()
    {
        return [
            Characteristic::TYPE_STRING => 'String',
            Characteristic::TYPE_INTEGER => 'Integer number',
            Characteristic::TYPE_FLOAT => 'Float number',
            Characteristic::TYPE_BOOLEAN => 'Boolean type',
            Characteristic::TYPE_MULTIPLE => 'Array with multiple options',
        ];
    }

    public static function typeName($type)
    {
        return ArrayHelper::getValue(self::typeList(), $type);
    }

//     public static function indexCharacteristics()
//     {
//         $characteristics=Characteristic::find()->all();

//         return ArrayHelper::index($characteristics,'id','name');
// //        return ArrayHelper::map($characteristics, 'name','id','slug']);        
//     }

        public static function mapCharacteristics($from='slug',$to='id')
    {
        $characteristics=Characteristic::find()->all();

        return ArrayHelper::map($characteristics,$from,$to);
    }
}