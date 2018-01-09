<?php

namespace core\entities\communication;

use core\helpers\UserHelper;
use Yii;
use core\entities\User\User;
/**
 * This is the model class for table "bnz_friend_requests".
 *
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $datetime
 * @property integer $seen
 * @property  integer $status
 * @property User $receiver
 * @property User $sender
 */
class FriendRequest extends \yii\db\ActiveRecord
{
    const PENDING=0;
    const ACCEPTED=1;
    const REJECTED=2;

    public static function create($sender_id,$receiver_id)
    {
        $new=new static();
        $new->sender_id=$sender_id;
        $new->receiver_id=$receiver_id;
        $new->datetime=date('Y-m-d H:i:s');
        $new->status=0;
        $new->seen=0;
        return $new;
    }
    public function edit($status)
    {
        $this->status=$status;
    }

    public function remove()
    {
        $this->delete();//->where(['sender_id'=>$this->sender_id])->andWhere(['receiver_id'=>$this->receiver_id])->andWhere(['status'=>$this->status]);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bnz_friend_requests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id'], 'required'],
            [['sender_id', 'receiver_id','seen','status'], 'integer'],
            [['datetime'], 'safe'],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            ['sender_id', 'compare','compareAttribute'=>'receiver_id','operator'=>'!=','message'=>'Sender and receiver are same.']
        ];
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
            'datetime' => 'Datetime',
            'seen' => 'Seen'
        ];
    }

    /**
     * @return array
     */
    public function prepareUsers() :array
    {
        return UserHelper::prepareBothnamesList();
    }

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

    public function statusList()
    {
        return [static::PENDING=>'Pending',static::ACCEPTED=>'Accepted',static::REJECTED=>'Rejected'];
    }
}
