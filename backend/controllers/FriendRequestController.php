<?php

namespace backend\controllers;

use Yii;
use core\repositories\communication\FriendRequestRepository;
use core\managers\communication\FriendRequestManager;
use core\entities\communication\FriendRequest;
use core\forms\search\FriendRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FriendRequestController implements the CRUD actions for FriendRequest model.
 */
class FriendRequestController extends Controller
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
    public function __construct($id, $module, FriendRequestRepository $repository, FriendRequestManager $manager,$config=[])
    {
        $this->repository=$repository;
        $this->manager=$manager;
        return parent::__construct($id, $module,$config);
    }

    /**
     * Lists all FriendRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FriendRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        var_dump($dataProvider->getModels());
//        die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FriendRequest model.
     * @param integer $sender_id
     * @param integer $receiver_id
     * @return mixed
     */
    public function actionView($sender_id, $receiver_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sender_id, $receiver_id),
        ]);
    }

    /**
     * Creates a new FriendRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new FriendRequest();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $request = $this->manager->create($form);
                return $this->redirect(['view','sender_id'=>$request->sender_id,'receiver_id'=>$request->receiver_id]);
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->getSession()->setFlash('error',$e->getMessage());
            }
        } else {
            return $this->render('create', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Updates an existing FriendRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $sender_id
     * @param integer $receiver_id
     * @return mixed
     */
    public function actionUpdate($sender_id, $receiver_id)
    {
        $request = $this->findModel($sender_id, $receiver_id);

        if ($request->load(Yii::$app->request->post()) && $request->validate()) {
            try
            {
                $this->manager->edit($request->sender_id,$request->receiver_id,$request->status);
                return $this->redirect(['view','sender_id'=>$request->sender_id,'receiver_id'=>$request->receiver_id]);
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        } else {
            return $this->render('update', [
                'model' => $request,
            ]);
        }
    }

    /**
     * Deletes an existing FriendRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($sender_id,$receiver_id)
    {
        $this->manager->remove($sender_id, $receiver_id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the FriendRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $sender_id
     * @param integer $receiver_id
     * @return FriendRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sender_id, $receiver_id)
    {
        if (($model = FriendRequest::findOne($sender_id.'-'.$receiver_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
