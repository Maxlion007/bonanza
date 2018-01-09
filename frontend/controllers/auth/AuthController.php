<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 20.09.2017
 * Time: 18:44
 */

namespace frontend\controllers\auth;

use Yii;
use yii\web\Controller;
use core\services\auth\AuthService;
use core\forms\auth\LoginForm;


class AuthController extends Controller
{

    private $service;

    public function __construct($id,$module,AuthService $service, $config=[])
    {
        parent::__construct($id,$module,$config);
        $this->service=$service;
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $user = $this->service->auth($form);
                Yii::$app->user->login($user,$form->rememberMe ? 3600 * 24 * 30 : 0);
//                var_dump(Yii::$app->user->identity);
//                die();
                return $this->goBack();
            }catch(\DomainException $e)
            {
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}