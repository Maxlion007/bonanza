<?php

namespace frontend\controllers\cabinet;
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


    public function actionSendTransaction()
    {
        $form = new UserTransactionForm();
        $form->sender_id=Yii::$app->user->identity->getId();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $message = $this->manager->create($form);
                if($message)
                {
                    Yii::$app->getSession()->setFlash('app','Transaction sent.');
                }
            }catch(\DomainException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->getSession()->setFlash('error',$e->getMessage());
            }
        }
        return $this->goBack();
    }

}
