<?php

namespace core\forms\transactions;

use core\entities\transactions\UserTransaction;
use core\helpers\SeenHelper;
use core\helpers\UserHelper;
use core\repositories\User\UserRepository;
use core\validators\WalletValidator;
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
class UserTransactionForm extends \yii\base\Model
{
    public $sender_id;
    public $receiver_id;
    public $message;
    public $amount;
    public $seen;
    public $datetime;
    /**
     * @inheritdoc
     */
    public function __construct(UserTransaction $transaction=null)
    {
        if($transaction)
        {
            $this->sender_id=$transaction->sender_id;
            $this->receiver_id=$transaction->receiver_id;
            $this->message=$transaction->message;
            $this->amount=$transaction->amount;
            $this->seen=$transaction->seen;
            $this->datetime=$transaction->datetime;
        }
        return parent::__construct();
    }

    public function rules()
    {
        return [
            [['sender_id','receiver_id','amount'],'required'],
            [['sender_id', 'receiver_id', 'amount','seen'], 'integer'],
            ['amount', 'integer'],
            ['amount', 'checkBalance'],
            [['message'], 'string'],
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
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'amount' => 'Amount',
            'message' => 'Message',
            'datetime' => 'Datetime',
            'seen' => 'Seen',
        ];
    }

    public function prepareUsers()
    {
        return UserHelper::prepareBothnamesList();
    }

    public function checkBalance($attribute, $params, $validator)
    {
        $transaction_barrier=100;

        $balance=Yii::$container->get(UserRepository::class)->get($this->sender_id)->wallet;

        if(($balance-$this->$attribute)<$transaction_barrier)
        {
            $this->addError($attribute, "Transaction denied. Your balance should remain higher than $transaction_barrier after transaction.");
        }
        return true;
    }

    public function prepareStatus()
    {
        return SeenHelper::statusList();
    }
}
