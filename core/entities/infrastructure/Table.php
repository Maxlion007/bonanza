<?php

namespace core\entities\infrastructure;

use core\forms\infrastructure\TableForm;
use Yii;
use core\entities\User\User;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * This is the model class for table "bnz_table".
 *
 * @property integer $id
 * @property string $datetime_start
 * @property string $datetime_end
 * @property integer $game_name
 * @property integer $started
 * @property integer $closed
 * @property integer $owner_id
 * @property integer $winner_id
 * @property integer $bank
 * @property ConditionValue[] $values
 * @property User $winner
 * @property User $owner
 * @property TableConnection[] $bnzTableConnections
 * @property TableLog[] $bnzTableLogs
 */
class Table extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function create(TableForm $form)
    {
        $new=new static();
        $new->datetime_start=$form->datetime_start;
        $new->datetime_end=$form->datetime_end;
        $new->game_name=$form->game_name;
        $new->started=$form->started;
        $new->closed=$form->closed;
        $new->owner_id=$form->owner_id;
        $new->winner_id=$form->winner_id;
        $new->bank=$form->bank;
        return $new;
    }

    public function edit(TableForm $form)
    {
        $this->datetime_start=$form->datetime_start;
        $this->datetime_end=$form->datetime_end;
        $this->game_name=$form->game_name;
        $this->started=$form->started;
        $this->closed=$form->closed;
        $this->owner_id=$form->owner_id;
        $this->winner_id=$form->winner_id;
        $this->bank=$form->bank;
    }

    public static function tableName()
    {
        return 'bnz_table';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime_start' => 'Datetime Start',
            'datetime_end' => 'Datetime End',
            'game_name' => 'Game Type',
            'started' => 'Started',
            'closed' => 'Closed',
            'owner_id' => 'Owner ID',
            'winner_id' => 'Winner ID',
            'bank'=>'Current Bank'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinner()
    {
        return $this->hasOne(User::className(), ['id' => 'winner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableConnections()
    {
        return $this->hasMany(TableConnection::className(), ['table_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableLogs()
    {
        return $this->hasMany(TableLog::className(), ['table_id' => 'id']);
    }

    public function getValues()
    {
        return $this->hasMany(ConditionValue::class, ['table_id' => 'id']);
    }

    public function setValue($id, $value)
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCondition($id)) {
                $val->change($value);
                $this->values = $values;
                return;
            }
        }
        $values[] = ConditionValue::create($id, $this->id,$value);
        $this->values = $values;
    }

    public function getValue($id)
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCondition($id)) {
                return $val;
            }
        }
        return ConditionValue::blank($id);
    }

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['values'],
            ],
        ];
    }

    public function getLogs()
    {
        return $this->hasMany(TableLog::class,['table_id'=>'id'])->orderBy('datetime');
    }

}
