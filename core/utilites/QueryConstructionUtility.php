<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 09.11.2017
 * Time: 17:51
 */

namespace core\utilites;

use core\utilites\ArrayUtility;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class QueryConstructionUtility
{

    public static function smartCondition(Query $query, array $condition,$strict=true)
    {
        error_reporting(E_ALL);

        //filter out associal array
        if(ArrayUtility::isSequential($condition))
        {
            $query->andWhere(['id'=>$condition]);//if array is not associative than in it contains only ids that are searched as usual by ActiveRecord
        }else //... otherwise it is in [$key=>$value] or ['or/and=>[$key=>$value]] notation (in this case condition should be transformed)
        {
            $data=[];
            if(isset($condition['or']) || isset($condition['and']))
            {
                if(isset($condition['or']))
                {
                    $data['or']=implode(' or ',static::transformCondition($condition['or'],$strict));
                    $data['or']="(".$data['or'].")";
                }
                if(isset($condition['and']))
                {
                    $data['and']=implode(' and ',static::transformCondition($condition['and'],$strict));
                    $data['and']="(".$data['and'].")";
                }
             }
            else
            {
                $data=static::transformCondition($condition,$strict);
            }
            $text = implode(' AND ',$data);
            $query->andWhere($text);
        }
//        var_dump($query->createCommand()->getRawSql());
        return $query;
    }

    public static function transformCondition(array $conditions, $strict=true)
    {
        $data=[];
        foreach($conditions as $key=>$condition) {
            $data[$key]=static::transformValue($key, $condition, $strict);
        }
        return $data;
    }


    public static function transformValue($key,$cond,$strict=true)
    {
        $tmp=[];
        $result='';
        if(is_array($cond))
        {
            if(ArrayUtility::isSequential($cond))
            {
                $result="$key IN (".static::wrapQueryElement($cond).")";
            }
            else
            {
                foreach($cond as $k=>$c)
                {
                    $tmp[]=static::transformValue($k,$c,$strict);
                }
                $result=implode(' AND ',$tmp);
            }
        }else
        {
            if($strict)
            {

                $result= " $key=".static::wrapQueryElement($cond);

            }else
            {
                $result= " $key LIKE '%$cond%'";
            }
        }
        return $result;
    }

    public static function wrapQueryElement($element)
    {
        try
        {
            switch (ArrayUtility::getElementType($element))
            {
                case 'numeric':
                    if(is_array($element))
                    {
                        $tmp=[];
                        foreach($element as $e)
                        {
                            $tmp[]=$e;
                        }
                        $element=implode(', ',$tmp);
                    }
                    break;
                case 'boolean':
                    if(is_array($element))
                    {
                        $tmp=[];
                        foreach($element as $e)
                        {
                            $tmp[]=(int)$e;
                        }
                        $element=implode(', ',$tmp);
                    }else
                    {
                        $element=(int)$element;
                    }
                    break;
                case 'string':
                    if(is_array($element))
                    {
                        $tmp=[];
                        foreach($element as $e)
                        {
                            $tmp[]="'".$e."'";
                        }
                        $element=implode(', ',$tmp);
                    }else
                    {
                        $element="'".$element."'";
                    }
                    break;
                default:
                    throw new \DomainException('The element is not bumeric, boolean or string.');
                    break;
            }
            return $element;

        }catch(\DomainException $e)
        {
            echo $e->getMessage();
        }
    }
}