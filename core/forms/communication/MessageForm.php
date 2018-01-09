<?php

namespace core\forms\communication;

use core\entities\communication\Message;
use Yii;
use core\entities\User\User;
use core\helpers\UserHelper;
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
class MessageForm extends \yii\base\Model
{
    public $author_id;
    public $receiver_id;
    public $message_text;
    public $datetime;
    public $seen;

    public function __construct(Message $message=null, array $config=[])
    {
        if($message)
        {
            $this->author_id=$message->author_id;
            $this->receiver_id=$message->receiver_id;
            $this->message_text=$message->message_text;
            $this->datetime=$message->datetime;
            $this->seen=$message->seen;
        }

        parent::__construct($config);
    }
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'bnz_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'receiver_id', 'message_text'], 'required'],
            [['author_id', 'receiver_id', 'seen'], 'integer'],
            [['message_text'], 'string'],
            [['datetime'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
            ['author_id', 'compare','compareAttribute'=>'receiver_id','operator'=>'!=','message'=>'Sender and receiver are same.']
        ];
    }

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

    public function prepareUsers()
    {
        return UserHelper::prepareUsernamesList();
    }
}
