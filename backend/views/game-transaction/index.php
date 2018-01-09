<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\GameTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Game Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Game Transaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'User',
                'value'=>function($model)
                {
                    return $model->user->getUsernameAndFullname();
                }
            ],
            'table_id',
            'amount',
            'datetime',

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
                            'title' => Yii::t('yii', 'Delete'),'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);}
                ]
            ],
        ],
    ]); ?>
</div>
