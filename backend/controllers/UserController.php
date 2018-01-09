<?php

namespace backend\controllers;

use Yii;
use core\entities\User\User;
use core\forms\User\UserForm;
use core\forms\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use core\repositories\User\UserRepository;
use core\managers\User\UserManager;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    private $repository;
    private $manager;
    public function __construct($id, $module, UserRepository $repository, UserManager $manager,$config=[])
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        var_dump($dataProvider->getModels());
//        die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new UserForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $user = $this->manager->createUser($form);
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

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);

        $form = new UserForm($user);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $this->manager->editUser($user->id,$form);
                return $this->redirect(['view', 'id' => $user->id]);
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        } else {
            return $this->render('update', [
                'model' => $form,
                'user'=>$user
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
