<?php

namespace backend\controllers;

use core\forms\infrastructure\AllGameConditionsForm;
use Yii;
use core\entities\infrastructure\TableLog;
use core\forms\infrastructure\TableLogForm;
use core\forms\search\TableLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use core\repositories\infrastructure\TableLogRepository;
use core\managers\infrastructure\TableLogManager;
/**
 * TableLogController implements the CRUD actions for TableLog model.
 */
class TableLogController extends Controller
{
    /**
     * @inheritdoc
     */
    private $repository;
    private $manager;
    public function __construct($id, $module, TableLogRepository $repository, TableLogManager $manager,$config=[])
    {
        $this->repository=$repository;
        $this->manager=$manager;
        return parent::__construct($id, $module,$config);
    }

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

    /**
     * Lists all TableLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TableLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        var_dump($dataProvider->getModels());
//        die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TableLog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TableLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new TableLogForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $tableLog = $this->manager->create($form);
                return $this->redirect(['view','id'=>$tableLog->id]);
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
     * Updates an existing TableLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $tableLog = $this->findModel($id);

        $form = new TableLogForm($tableLog);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $this->manager->edit($tableLog->id,$form);
                return $this->redirect(['view', 'id' => $tableLog->id]);
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        } else {
            return $this->render('update', [
                'form' => $form,
                'model'=>$tableLog
            ]);
        }
    }

    /**
     * Deletes an existing TableLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TableLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TableLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TableLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
