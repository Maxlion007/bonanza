<?php

namespace core\helpers;

use yii\helpers\ArrayHelper;
use core\entities\infrastructure\GameCondition;

class GameConditionHelper
{
    public static function typeList()
    {
        return [
            GameCondition::TYPE_STRING => 'String',
            GameCondition::TYPE_INTEGER => 'Integer number',
            GameCondition::TYPE_FLOAT => 'Float number',
            GameCondition::TYPE_BOOLEAN => 'Boolean type',
            GameCondition::TYPE_MULTIPLE => 'Array with multiple options',
        ];
    }

    public static function typeName($type)
    {
        return ArrayHelper::getValue(self::typeList(), $type);
    }

//     public static function indexCharacteristics()
//     {
//         $characteristics=GameCondition::find()->all();

//         return ArrayHelper::index($characteristics,'id','name');
// //        return ArrayHelper::map($characteristics, 'name','id','slug']);        
//     }

        public static function mapCharacteristics($from='slug',$to='id')
    {
        $characteristics=GameCondition::find()->all();

        return ArrayHelper::map($characteristics,$from,$to);
    }
}