<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 30.05.17
 * Time: 11:08
 */

namespace core\entities\infrastructure;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use core\entities\infrastructure\GameCondition;

/**
 * @property integer $condition_id
 * @property string $value
 * @property string $table_id
 * @property GameCondition $condition
 */

class ConditionValue extends ActiveRecord
{

//    public function __construct($condition='',$value='',$table='',$config=[])
//    {
//        $this->condition_id=(integer) $condition;
//        $this->value=(string) $value;
//        $this->table_id=$table;
//        parent::__construct($config);
//    }

    public static function create($condition_id,$table_id, $value)
    {
        $object = new static();
        $object->table_id=$table_id;
        $object->condition_id = $condition_id;
        $object->value = $value;
        return $object;
    }

    public static function blank($conditionId)
    {
        $object = new static();
        $object->condition_id = $conditionId;
        return $object;
    }

    public function edit($value)
    {
        $this->value = $value;
    }

    public function isForCondition($id)
    {
        return $this->condition_id == $id;
    }

    public function getCondition()
    {
        return $this->hasOne(GameCondition::class, ['id' => 'condition_id']);
    }

    public static function tableName()
    {
        return '{{%bnz_condition_values}}';
    }
}