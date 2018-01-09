<?php

namespace backend\controllers;

use core\forms\User\CountryForm;
use Yii;
use core\entities\User\Country;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use core\forms\search\CountrySearch;
use core\repositories\User\CountryRepository;
use core\managers\User\CountryManager;
use core\forms\User\UserForm;
/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{

    private $manager;
    private $repository;

    public function __construct($id, $module, CountryRepository $repository,CountryManager $manager, $config=[])
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
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Country model.
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
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CountryForm();
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
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $form = new CountryForm();
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
     * Deletes an existing Country model.
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
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
