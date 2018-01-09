<?php
namespace frontend\controllers;

use core\helpers\GameHelper;
use Yii;
use yii\web\Controller;
use core\repositories\ObjectRepository;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class SiteController extends Controller
{


    public function beforeAction($action)
    {

        if ($action->id == 'index') {
            if (!Yii::$app->user->isGuest) {
                Yii::$app->user->identity->goHome();
            }
        }
        return parent::beforeAction($action);

    }

    private $tables;

    public function __construct($id, $module,$config=[])
    {
        return parent::__construct($id,$module);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
        ];
    }
    public function actionIndex()
    {

        return $this->render('index',
            [
            ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRules($game_type)
    {
        GameHelper::checkGameName($game_type);
        return $this->render($game_type.'_rules');
    }
}
