<?php

namespace core\forms\User;

use core\entities\User\User;
use core\helpers\UserHelper;
use core\repositories\User\CountryRepository;
use core\validators\PhoneValidator;
use core\entities\User\Country;
use core\forms\CompositeForm;
use core\forms\User\PhotosForm;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bnz_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email_confirm_token
 * @property integer $gender
 * @property string $birthday
 * @property integer $country_id
 * @property string $about
 * @property string $avatar_id
 * @property integer $wallet
 * @property string $auth_key
 * @property string $created_at
 * @property string $updated_at
 * @property integer $played_games
 * @property string $phone
 * @property integer $status
 */
//class UserForm extends Model
class UserForm extends CompositeForm
    {
    public $username;
    public $fullname;
    public $password;
    public $email;
    public $phone;
    public $gender;
    public $birthday;
    public $country_id;
    public $about;
    public $wallet;
    public $played_games;
    public $avatar_id;
    public $status;
    public $_user;

    public function __construct(User $user=null,array $config = [])
    {

        if($user)
        {
            $this->username=$user->username;
            $this->fullname=$user->fullname;
            $this->email=$user->email;
            $this->phone=$user->phone;
            $this->gender=$user->gender;
            $this->birthday=$user->birthday;
            $this->country_id=$user->country_id;
            $this->about=$user->about;
            $this->avatar_id=$user->avatar_id;
            $this->wallet=$user->wallet;
            $this->played_games=$user->played_games;
            $this->_user=$user;
        }
        $this->status=User::STATUS_ACTIVE;
        $this->photos= new PhotosForm();
        return parent::__construct($config);
    }


    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'fullname','email', 'gender', 'birthday', 'country_id', 'phone','about'], 'required'],
            [['country_id','wallet','played_games'], 'integer'],
            ['birthday', 'date','format'=>'yyyy-mm-dd'],
            ['birthday','validateAge'],
            [['about'], 'string'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['gender', 'fullname','username', 'email', 'password', 'phone'], 'string', 'max' => 255],
            [['avatar_id'], 'string', 'max' => 500],
            ['phone',PhoneValidator::class,'message'=>"Wrong phone number format"],
            [['username','email'], 'unique','targetClass'=>User::class, 'filter' => ['<>', 'id', isset($this->_user)?$this->_user->id:null]],
        ];
    }

    public function validateAge($attribute, $params, $validator)
    {
        $date = strtotime($this->$attribute);
        $diff=time()-$date;
        //$date = \DateTime::createFromFormat('d-M-Y', $age);
        if($diff<568024668)
        {
            $this->addError($attribute, 'You must be at least 18 years old to proceed.');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email_confirm_token' => 'Email Confirm Token',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'country_id' => 'Country',
            'about' => 'About',
            'avatar_id' => 'avatar_id',
            'wallet' => 'Wallet',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'played_games' => 'Played Games',
            'phone' => 'Phone',
            'status' => 'Status',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function internalForms()
    {
        return ['photos'];
    }

    public static function prepareGenders()
    {
        return UserHelper::genderList();
    }

}
