<?php

namespace core\entities\User;

use core\forms\User\UserSuspensionForm;
use Yii;
use core\entities\User\User;
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
class UserSuspension extends \yii\db\ActiveRecord
{

    public static function create(UserSuspensionForm $form)
    {
        $new= new static();
        $new->user_id=$form->user_id;
        $new->datetime_end=$form->datetime_end;
        $new->reason=$form->reason;
        return $new;
    }

    public function edit(UserSuspensionForm $form)
    {
        $this->user_id=$form->user_id;
        $this->datetime_end=$form->datetime_end;
        $this->reason=$form->reason;
    }

    /**
     * @inheritdoc
     */


    public static function tableName()
    {
        return 'bnz_user_suspension';
    }

//    /**
//     * @inheritdoc
//     */
//    public function rules()
//    {
//        return (new UserSuspensionForm())->rules();
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'datetime_end' => 'Datetime End',
            'reason' => 'Reason',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
