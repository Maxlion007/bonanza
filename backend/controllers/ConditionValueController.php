<?php

namespace backend\controllers;

use core\forms\infrastructure\ConditionValueForm;
use Yii;
use core\entities\infrastructure\ConditionValue;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use core\forms\search\ConditionValueSearch;
use core\repositories\infrastructure\ConditionValueRepository;
use core\managers\infrastructure\ConditionValueManager;
/**
 * ConditionValueController implements the CRUD actions for ConditionValue model.
 */
class ConditionValueController extends Controller
{

    private $manager;
    private $repository;

    public function __construct($id, $module, ConditionValueRepository $repository,ConditionValueManager $manager, $config=[])
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
     * Lists all ConditionValue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConditionValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConditionValue model.
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
     * Creates a new ConditionValue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ConditionValueForm();
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
     * Updates an existing ConditionValue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $form = new ConditionValueForm();
        $model=$this->findModel($id);
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
     * Deletes an existing ConditionValue model.
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
     * Finds the ConditionValue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConditionValue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConditionValue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
