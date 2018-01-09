<?php

namespace core\entities\communication;

use Yii;
use core\entities\User\User;
use core\forms\communication\MessageForm;
/**
 * This is the model class for table "bnz_message".
 *
 * @property integer $id
 * @property integer $author_id
 * @property integer $receiver_id
 * @property string $message_text
 * @property string $datetime
 * @property integer $seen
 *
 * @property User $author
 * @property User $receiver
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function create(MessageForm $form)
    {
        $new= new static();
        $new->author_id=$form->author_id;
        $new->receiver_id=$form->receiver_id;
        $new->message_text=$form->message_text;
        $form->datetime?$new->datetime=$form->datetime:$new->datetime=date('Y-m-d H:i:s');
        $form->seen?$new->seen=$form->seen:$new->seen=0;
        return $new;
    }

    public function edit(MessageForm $form)
    {
        $this->author_id=$form->author_id;
        $this->receiver_id=$form->receiver_id;
        $this->message_text=$form->message_text;
        $this->datetime=$form->datetime;
        $this->seen=$form->seen;
    }

    public static function tableName()
    {
        return 'bnz_message';
    }

//    /**
//     * @inheritdoc
//     */
//    public function rules()
//    {
//        return (new MessageForm())->rules();
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'receiver_id' => 'Receiver ID',
            'message_text' => 'Message Text',
            'datetime' => 'Datetime',
            'seen' => 'Seen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }
}
