<?php

namespace backend\forms;


use Yii;
use yii\base\Model;
use backend\entities\Admin;

/**
 * Login form
 */
class AdminLoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe;

    /**
     * @inheritdoc
     */
    public function getUser()
    {
        if($this->_user ===false)
        {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function auth()
    {
        $admin=Admin::findByUsername($this->username);

        if($admin && $this->password) {
            if(!$admin->validatePassword($this->password))
            {
                throw new \DomainException('Wrong password');
            }
        }
        else
        {
            throw new \DomainException('Undefined user or password.');
        }
        return $admin;
    }

    public function login($duration = 0)
    {

        $identity=$this->auth();
        $identity->switchIdentity($identity, $duration);
        $id = $identity->getId();
        $ip = Yii::$app->getRequest()->getUserIP();
        if ($identity->enableSession) {
            $log = "Admin logged in from $ip with duration $duration.";

        } else {
            $log = "Admin logged in from $ip. Session not enabled.";
        }
        Yii::info($log, __METHOD__);
    }


    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            [['username','password'], 'string']
        ];
    }

}
