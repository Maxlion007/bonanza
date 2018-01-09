<?php

namespace backend\controllers;

use Yii;
use core\forms\transactions\UserTransactionForm;
use core\repositories\transactions\UserTransactionRepository;
use core\managers\transactions\UserTransactionManager;
use core\entities\transactions\UserTransaction;
use core\forms\search\UserTransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserTransactionController implements the CRUD actions for UserTransaction model.
 */
class UserTransactionController extends Controller
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
    public function __construct($id, $module, UserTransactionRepository $repository, UserTransactionManager $manager, $config=[])
    {
        $this->repository=$repository;
        $this->manager=$manager;
        return parent::__construct($id, $module,$config);
    }

    /**
     * Lists all UserTransaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserTransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        var_dump($dataProvider->getModels());
//        die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserTransaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserTransaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new UserTransactionForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $user = $this->manager->create($form);
                return $this->redirect(['view','id'=>$user->id]);
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

//    /**
//     * Updates an existing UserTransaction model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionUpdate($id)
//    {
//        $subject = $this->findModel($id);
//
//        $form = new UserTransactionForm($subject);
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

    /**
     * Deletes an existing UserTransaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->manager->remove($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserTransaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserTransaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTransaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
