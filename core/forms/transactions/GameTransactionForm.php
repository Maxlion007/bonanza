<?php

namespace core\forms\transactions;
use core\entities\transactions\GameTransaction;
use core\helpers\UserHelper;
use core\repositories\User\UserRepository;
use Yii;
use core\entities\User\User;
use core\entities\infrastructure\Table;
use core\repositories\infrastructure\TableRepository;
/**
 * This is the model class for table "bnz_transactions".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $table_id
 * @property integer $amount
 * @property string $datetime
 *
 * @property User $table
 * @property User $user
 */
class GameTransactionForm extends \yii\base\Model
{
    public $user_id;
    public $table_id;
    public $amount;
    public $datetime;
    /**
     * @inheritdoc
     */
    public function __construct(GameTransaction $transaction=null)
    {
        if($transaction)
        {
            $this->user_id=$transaction->user_id;
            $this->table_id=$transaction->table_id;
            $this->amount=$transaction->amount;
            $this->datetime=$transaction->datetime;
        }
        return parent::__construct();
    }

    public function rules()
    {
        return [
            [['user_id', 'table_id','amount'], 'required'],
            [['user_id', 'table_id'], 'integer'],
            ['amount', 'integer'],
            ['amount', 'checkBalance'],
            [['datetime'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['table_id'], 'exist', 'skipOnError' => true, 'targetClass' => Table::className(), 'targetAttribute' => ['table_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'table_id' => 'Table ID',
            'amount' => 'Amount',
            'datetime' => 'Datetime',
        ];
    }

    public function prepareUsers()
    {
        return UserHelper::prepareBothnamesList();
    }

    public function checkBalance($attribute, $params, $validator)
    {
        $transaction_barrier=0;

        $table_balance=Yii::$container->get(TableRepository::class)->get($this->table_id)->bank;
        $user_balance=Yii::$container->get(UserRepository::class)->get($this->user_id)->wallet;
        if(($table_balance+$this->$attribute)<$transaction_barrier || ($user_balance-$this->$attribute)<$transaction_barrier)
        {
            $this->addError($attribute, "Transaction denied. $table_balance $user_balance The balance should remain higher than $transaction_barrier after transaction.");
        }
        return true;
    }
}
