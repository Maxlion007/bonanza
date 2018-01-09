<?php
/**
 * Created by PhpStorm.
 * SubjectClass: Max
 * Date: 21.09.2017
 * Time: 19:03
 */

namespace core\repositories;

use yii\db\Exception;
use yii\db\Query;
use core\utilites\QueryConstructionUtility;

class ObjectRepository
{
    public $subjectClass;


    public function __construct($subjectClass)
    {
        $this->subjectClass=$subjectClass;
    }

    public function count(array $condition=[])
    {
        $subject= new $this->subjectClass();
        $query=$subject::find();
        if(!empty($condition) && $condition)
        {
            $query->andWhere($condition);
        }
        return $query->count();
    }

    public function save($subject)
    {
        try{
            if (!$subject->save()) {
                throw new \DomainException('Saving error.');
            }
        }catch(Exception $e)
        {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }
        return true;
    }

    public function remove($subject)
    {
        try{
            if (!$subject->delete()) {
                throw new \RuntimeException('Deletion error.');
            }
        }catch(Exception $e)
        {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }
        return true;
    }
    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }

    public function getBy(array $condition)
    {
        $subject=$this->subjectClass;
        if (!$subject = $subject::find()->andWhere($condition)->limit(1)->one()) {
            throw new \RuntimeException("Object of class '{$this->subjectClass}' not found");
        }
        return $subject;
    }

    public function getAll(array $condition=[], $strict = true) {
        $subject=$this->subjectClass;
        $query=$subject::find();
        if(!empty($condition))
        {
            $query=QueryConstructionUtility::smartCondition($query,$condition,$strict);
        }

        if (!$subjects = $query->all()) {
            throw new \DomainException("No object of class \'{$this->subjectClass}\' not found");
        }
        return $subjects;
    }


    public function getInfoBy(array $info, array $condition, $strict=false)
    {
        $query = new Query();
        $subject=new $this->subjectClass();
        $query->select($info)->from($subject::tableName());

        $query=QueryConstructionUtility::smartCondition($query,$condition,$strict);

        $result=$query->all();

        return $result;
    }


    public function extractData(array $array, $fields)
    {
        $result=[];
        foreach($array as $a)
        {
            foreach($fields as $field)
            {
                switch(strtolower(gettype($a)))
                {
                    case 'array':
                        $result[$field]=$a[$field];
                        break;
                    case 'object':
                        $result[$field]=$a->$field;
                        break;
                }
            }
        }
        return $result;
    }
}