<?php

namespace core\forms\User;

use core\entities\User\UserSuspension;
use Yii;
use core\entities\User\User;
use core\helpers\UserHelper;
/**
 * This is the model class for table "bnz_user_suspension".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $datetime_end
 * @property string $reason
 *
 * @property User $user
 */
class UserSuspensionForm extends \yii\base\Model
{
    /**
     * @inheritdoc
     */
    public $user_id;
    public $datetime_end;
    public $reason;

    public function __construct(UserSuspension $suspension=null, array $config = [])
    {
        if($suspension)
        {
            $this->user_id=$suspension->user_id;
            $this->datetime_end=$suspension->datetime_end;
            $this->reason=$suspension->reason;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['datetime_end'], 'safe'],
            [['reason'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'datetime_end' => 'Datetime End',
            'reason' => 'Reason',
        ];
    }

    public function prepareUsers()
    {
        return UserHelper::prepareUsernamesList(true);
    }
}
