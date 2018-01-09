<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 24.05.17
 * Time: 12:01
 */

namespace frontend\controllers\cabinet;


use frontend\controllers\AppController;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

//    public function beforeAction($action)
//    {
//
//        $this->layout='/cabinet/main';
//        parent::beforeAction($action);
//    }


    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='/cabinet/main';
        $user=Yii::$app->user->identity;
        return $this->render('index',['user'=>$user]);
    }
}