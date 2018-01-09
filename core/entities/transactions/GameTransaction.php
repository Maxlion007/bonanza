<?php

namespace core\entities\transactions;

use Yii;
use core\entities\User\User;
use core\entities\infrastructure\Table;
use core\forms\transactions\GameTransactionForm;
/**
 * This is the model class for table "bnz_game_transactions".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $table_id
 * @property string $amount
 * @property string $datetime
 *
 * @property User $user
 * @property Table $table
 */

class GameTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function create(GameTransactionForm $form)
    {
        $new=new static();
        $new->user_id=$form->user_id;
        $new->table_id=$form->table_id;
        $new->amount=$form->amount;
        $form->datetime?$new->datetime=$form->datetime:$new->datetime=date('Y-m-d H:i:s');
        return $new;
    }

//    public function edit(GameTransactionForm $form)
//    {
//        $this->user_id=$form->user_id;
//        $this->table_id=$form->table_id;
//        $this->amount=$form->amount;
//        $form->datetime?$this->datetime=$form->datetime:$this->datetime=date('Y-m-d H:i:s');
//    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bnz_game_transactions';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'table_id' => 'Table ID',
            'amount' => 'Amount',
            'datetime' => 'Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Table::className(), ['id' => 'table_id']);
    }
}
