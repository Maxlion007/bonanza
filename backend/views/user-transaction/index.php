<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\UserTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create UserTransaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'Sender',
                'value'=>function($model)
                {
                    return $model->sender->getUsernameAndFullname();
                }
            ],

            ['attribute'=>'receiver',
                'value'=>function($model)
                {
                    return $model->receiver->getUsernameAndFullname();
                }
            ],

            'amount',
            'message:ntext',
             'datetime',
            // 'status',
            // 'seen',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{delete}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('yii', 'View'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                    ]);}
                ]
            ],
        ],
    ]); ?>
</div>
