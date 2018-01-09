<?php

namespace frontend\controllers\cabinet;

use Yii;
use core\forms\communication\MessageForm;
use core\repositories\communication\MessageRepository;
use core\managers\communication\MessageManager;
use core\entities\communication\Message;
use core\forms\search\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    private $repository;
    private $manager;
    public function __construct($id, $module, MessageRepository $repository, MessageManager $manager,$config=[])
    {
        $this->repository=$repository;
        $this->manager=$manager;
        return parent::__construct($id, $module,$config);
    }

    public function actionSendMessage()
    {
        $form = new MessageForm();
        $form->author_id=Yii::$app->user->identity->getId();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $message = $this->manager->create($form);
                if($message)
                {
                    Yii::$app->getSession()->setFlash('app','Message sent.');
                }
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->getSession()->setFlash('error',$e->getMessage());
            }
        }
        return $this->goBack();
    }

//    /**
//     * Updates an existing Message model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionUpdate($id)
//    {
//        $subject = $this->findModel($id);
//
//        $form = new MessageForm($subject);
//
//        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
//            try
//            {
//                $this->manager->edit($subject->id,$form);
//                return $this->redirect(['view', 'id' => $subject->id]);
//            }catch(\DomainException $e)
//            {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('error',$e->getMessage());
//            }
//        } else {
//            return $this->render('update', [
//                'model' => $form,
//                'subject'=>$subject
//            ]);
//        }
//    }
//
//    /**
//     * Deletes an existing Message model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionDelete($id)
//    {
//        $this->manager->remove($id);
//
//        return $this->redirect(['index']);
//    }
//
//    /**
//     * Finds the Message model based on its primary key value.
//     * If the model is not found, a 404 HTTP exception will be thrown.
//     * @param integer $id
//     * @return Message the loaded model
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    protected function findModel($id)
//    {
//        if (($model = Message::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }
}
