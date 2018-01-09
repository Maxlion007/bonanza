<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 09.11.2017
 * Time: 17:51
 */

namespace core\utilites;


use yii\helpers\ArrayHelper;

class ArrayUtility
{
    /* check if array is not associative*/
    public static function isSequential(array $array)
    {
        $keys=array_keys($array);
        $isSequential=true;
        for($i=0;$i<count($keys);$i++)
        {
            if($keys[$i]!==$i)
            {
                $isSequential=false;
            }
        }
        return $isSequential;
    }

    public static function isAssociative(array $array)
    {
        $keys=array_keys($array);
        $isAssociative=true;
        for($i=0;$i<count($keys);$i++)
        {
            if($keys[$i]!=$i)
            {
                $isAssociative=false;
            }
        }
        return $isAssociative;
    }

    public static function getElementType($array)
    {
        $type=[];
        if(is_array($array))
        {
            foreach($array as $element)
            {
                $result=static::filterType($element);
//                echo $result;
                $type[$result]=true;
            }
            if(!$type['object'] && !$type['mixed'])
            {
                if($type['numeric'] && $type['string'] && !$type['array'])
                {
                    return 'string';
                }
                elseif($type['numeric'] && $type['boolean'] && !$type['array'])
                {
                    return 'numeric';
                }
            }
            $type=array_unique(array_keys($type));
            $type=count($type)>1?'mixed':reset($type);
            return $type;
        }elseif(is_object($array))
        {
            return $array::className();
//            throw new \DomainException('The element is object');
        }else
        {
            return static::filterType($array);
        }
    }

    public static function filterType($variable)
{
    if(is_bool($variable))
    {
        return 'boolean';
    }elseif(is_numeric($variable))
    {
        return 'numeric';
    }elseif(is_string($variable))
    {
        return 'string';
    }elseif(is_array($variable)){
        return 'array';
    }elseif(is_object($variable)){
        return 'object';
    }
    else
    {
        throw new \DomainException('Unknown variable type');
    }
}

public static function advancedIndex($array, $index,$column)
{
    $result=[];
    foreach($array as $element)
    {
        $result[static::getAttribute($element,$index)]=static::getAttribute($element,$column);
    }
    return $result;
}




public static function extractData($array, $column)
{
    return array_map(function($e) use ($column)
    {
        return static::getAttribute($e,$column);
    }, $array);
}

public static function getAttribute($subject, $column)
{
    $is_function=false;
    if(strpos($column,')')==strlen($column)-1 && strpos($column,'(')==strlen($column)-2)
    {
        $column=substr($column, 0,strlen($column)-2);
        $is_function=true;
    }

    if(is_object($subject))
    {
        if($is_function)
        {
            return $subject->$column();
        }
        return $subject->$column;
    }
    return $subject[$column];
}
}