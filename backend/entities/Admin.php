<?php

namespace backend\entities;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 */

class Admin extends ActiveRecord implements IdentityInterface
{
//    public $username;
//    public $password_hash;
    public $identityClass;
    /**
     * @var bool whether to enable cookie-based login. Defaults to `false`.
     * Note that this property will be ignored if [[enableSession]] is `false`.
     */
    public $enableAutoLogin = false;
    /**
     * @var bool whether to use session to persist authentication status across multiple requests.
     * You set this property to be `false` if your application is stateless, which is often the case
     * for RESTful APIs.
     */
    public $enableSession = true;
    /**
     * @var string|array the URL for login when [[loginRequired()]] is called.
     * If an array is given, [[UrlManager::createUrl()]] will be called to create the corresponding URL.
     * The first element of the array should be the route to the login action, and the rest of
     * the name-value pairs are GET parameters used to construct the login URL. For example,
     *
     * ```php
     * ['site/login', 'ref' => 1]
     * ```
     *
     * If this property is `null`, a 403 HTTP exception will be raised when [[loginRequired()]] is called.
     */
    public $loginUrl = ['site/login'];
    /**
     * @var array the configuration of the identity cookie. This property is used only when [[enableAutoLogin]] is `true`.
     * @see Cookie
     */
    public $identityCookie = ['name' => '_identity', 'httpOnly' => true];
    /**
     * @var int the number of seconds in which the user will be logged out automatically if he
     * remains inactive. If this property is not set, the user will be logged out after
     * the current session expires (c.f. [[Session::timeout]]).
     * Note that this will not work if [[enableAutoLogin]] is `true`.
     */
    public $authTimeout;
    /**
     * @var CheckAccessInterface The access checker to use for checking access.
     * If not set the application auth manager will be used.
     * @since 2.0.9
     */
    public $accessChecker;
    /**
     * @var int the number of seconds in which the user will be logged out automatically
     * regardless of activity.
     * Note that this will not work if [[enableAutoLogin]] is `true`.
     */
    public $absoluteAuthTimeout;
    /**
     * @var bool whether to automatically renew the identity cookie each time a page is requested.
     * This property is effective only when [[enableAutoLogin]] is `true`.
     * When this is `false`, the identity cookie will expire after the specified duration since the user
     * is initially logged in. When this is `true`, the identity cookie will expire after the specified duration
     * since the user visits the site the last time.
     * @see enableAutoLogin
     */
    public $autoRenewCookie = true;
    /**
     * @var string the session variable name used to store the value of [[id]].
     */
    public $idParam = '__id';
    /**
     * @var string the session variable name used to store the value of expiration timestamp of the authenticated state.
     * This is used when [[authTimeout]] is set.
     */
    public $authTimeoutParam = '__expire';
    /**
     * @var string the session variable name used to store the value of absolute expiration timestamp of the authenticated state.
     * This is used when [[absoluteAuthTimeout]] is set.
     */
    public $absoluteAuthTimeoutParam = '__absoluteExpire';
    /**
     * @var string the session variable name used to store the value of [[returnUrl]].
     */
    public $returnUrlParam = '__returnUrl';
    /**
     * @var array MIME types for which this component should redirect to the [[loginUrl]].
     * @since 2.0.8
     */
    public $acceptableRedirectTypes = ['text/html', 'application/xhtml+xml'];

    private $_access = [];

    private $_identity = false;


    public static function create($username, $password)
    {
        $user = new Admin();
        $user->username = $username;
        $user->setPassword(!empty($password) ? $password : Yii::$app->security->generateRandomString());
        $user->created_at = time();
        $user->auth_key = Yii::$app->security->generateRandomString();
        return $user;
    }


    public function edit( $username,  $password)
    {
        $this->username = $username;
        $this->setPassword(!empty($password) ? $password : Yii::$app->security->generateRandomString());
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bnz_admin';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['networks', 'model', 'client', 'categoryAssignments', 'photos', 'values'],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    private function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function switchIdentity($identity, $duration = 0)
    {
        $this->setIdentity($identity);

        if (!$this->enableSession) {
            return;
        }

        /* Ensure any existing identity cookies are removed. */
        if ($this->enableAutoLogin) {
            $this->removeIdentityCookie();
        }

        $session = Yii::$app->getSession();
        if (!YII_ENV_TEST) {
            $session->regenerateID(true);
        }
        $session->remove($this->idParam);
        $session->remove($this->authTimeoutParam);

        if ($identity) {
            $session->set($this->idParam, $identity->getId());
            if ($this->authTimeout !== null) {
                $session->set($this->authTimeoutParam, time() + $this->authTimeout);
            }
            if ($this->absoluteAuthTimeout !== null) {
                $session->set($this->absoluteAuthTimeoutParam, time() + $this->absoluteAuthTimeout);
            }
            if ($duration > 0 && $this->enableAutoLogin) {
                $this->sendIdentityCookie($identity, $duration);
            }
        }
    }

    public function setIdentity($identity)
    {
        if ($identity instanceof IdentityInterface) {
            $this->_identity = $identity;
            $this->_access = [];
        } elseif ($identity === null) {
            $this->_identity = null;
        } else {
            throw new \yii\base\InvalidValueException('The identity object must implement IdentityInterface.');
        }
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function validateAuthKey($authKey)
    {
//        return $this->getAuthKey() === $authKey;
        throw new NotSupportedException('"validateAuthKey" is not implemented.');
    }

    public function getAuthKey()
    {
//        return $this->auth_key;
        throw new NotSupportedException('"getAuthKey" is not implemented.');
    }

}
