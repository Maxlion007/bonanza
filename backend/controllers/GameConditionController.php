<?php

namespace backend\controllers;

use core\forms\infrastructure\GameConditionForm;
use Yii;
use core\entities\infrastructure\GameCondition;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use core\forms\search\GameConditionSearch;
use core\repositories\infrastructure\GameConditionRepository;
use core\managers\infrastructure\GameConditionManager;
/**
 * GameConditionController implements the CRUD actions for GameCondition model.
 */
class GameConditionController extends Controller
{

    private $manager;
    private $repository;

    public function __construct($id, $module, GameConditionRepository $repository,GameConditionManager $manager, $config=[])
    {
        $this->repository=$repository;
        $this->manager=$manager;
        return parent::__construct($id, $module,$config);
    }
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

    /**
     * Lists all GameCondition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GameConditionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GameCondition model.
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
     * Creates a new GameCondition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new GameConditionForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {

                $model=$this->manager->create($form);
                if($model)
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }catch(\DomainException $e)
            {
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        } else {
            return $this->render('create', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Updates an existing GameCondition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model=$this->findModel($id);
        $form = new GameConditionForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $this->manager->edit($id,$form);
                return $this->redirect(['view', 'id' => $model->id]);
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'form' => $form,
                'model'=>$model
            ]);
        }
    }

    /**
     * Deletes an existing GameCondition model.
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
     * Finds the GameCondition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameCondition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameCondition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
