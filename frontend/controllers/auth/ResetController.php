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
use core\services\auth\PasswordResetService;
use core\forms\auth\PasswordResetRequestForm;
use core\forms\auth\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;



class ResetController extends Controller
{

    private $service;

    public function __construct($id,$module,PasswordResetService $service, $config=[])
    {
        parent::__construct($id,$module,$config);
        $this->service=$service;
    }

    public function actionRequest()
    {
        $model = new PasswordResetRequestForm();
        $service=$this->service;
        //Yii::$container->get(PasswordResetService::class);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try
            {
                if ($service->request($model)) {
                    Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                    return $this->goHome();
                }
            }
            catch(\DomainException $e)
            {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionReset($token)
    {
        //$service= Yii::$container->get(PasswordResetService::class);
        $service=$this->service;

        $form = new ResetPasswordForm();
        try {
            $service->validateToken($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $service->reset($token,$form);
                Yii::$app->session->setFlash('success','New password saved');
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $form,
        ]);
    }
}