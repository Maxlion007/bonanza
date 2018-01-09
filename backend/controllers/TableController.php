<?php

namespace backend\controllers;

use core\forms\infrastructure\AllGameConditionsForm;
use Yii;
use core\entities\infrastructure\Table;
use core\forms\infrastructure\TableForm;
use core\forms\search\TableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use core\repositories\infrastructure\TableRepository;
use core\managers\infrastructure\TableManager;
/**
 * TableController implements the CRUD actions for Table model.
 */
class TableController extends Controller
{
    /**
     * @inheritdoc
     */
    private $repository;
    private $manager;
    public function __construct($id, $module, TableRepository $repository, TableManager $manager,$config=[])
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
     * Lists all Table models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        var_dump($dataProvider->getModels());
//        die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Table model.
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
     * Creates a new Table model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($game_type)
    {
        $form = new TableForm($game_type);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $table = $this->manager->create($form);
                return $this->redirect(['view','id'=>$table->id]);
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
     * Updates an existing Table model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $table = $this->findModel($id);

        $form = new TableForm($table->game_type,$table);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $this->manager->edit($table->id,$form);
                return $this->redirect(['view', 'id' => $table->id]);
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        } else {
            return $this->render('update', [
                'model' => $form,
                'subject'=>$table
            ]);
        }
    }

    /**
     * Deletes an existing Table model.
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
     * Finds the Table model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Table the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Table::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
