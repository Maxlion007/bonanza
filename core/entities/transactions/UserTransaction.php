<?php

namespace core\entities\transactions;

use core\forms\transactions\UserTransactionForm;
use Yii;
use core\entities\User\User;
/**
 * This is the model class for table "bnz_transactions".
 *
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property integer $amount
 * @property string $message
 * @property string $datetime
 * @property integer $seen
 *
 * @property User $receiver
 * @property User $sender
 */
class UserTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function create(UserTransactionForm $form)
    {
        $new=new static();
        $new->sender_id=$form->sender_id;
        $new->receiver_id=$form->receiver_id;
        $new->amount=$form->amount;
        $new->message=$form->message;
        $form->datetime?$new->datetime=$form->datetime:$new->datetime=date('Y-m-d H:i:s');
        $new->seen=0;
        return $new;
    }

//    public function edit(UserTransactionForm $form)
//    {
//        $this->message=$form->message;
//        $this->amount=$form->amount;
//        $this->seen=$form->seen;
//    }

    public static function tableName()
    {
        return 'bnz_user_transactions';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'amount' => 'Amount',
            'message' => 'Message',
            'datetime' => 'Datetime',
            'seen' => 'Seen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }
}
