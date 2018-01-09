<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 20.09.2017
 * Time: 18:44
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use core\services\ContactService;
use core\forms\ContactForm;


class ContactController extends Controller
{

    private $service;

    public function __construct($id,$module,ContactService $service, $config=[])
    {
        parent::__construct($id,$module,$config);
        $this->service=$service;
    }

    public function actionIndex()
    {
        $form = new ContactForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->goHome();
            }
            catch(\Exception $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }


}