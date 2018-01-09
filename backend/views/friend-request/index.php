<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\FriendRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Friend Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Friend Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'Sender',
            'value'=>function($model)
                {
                    return $model->sender->getUsernameAndFullname();
                }
            ],
            ['attribute'=>'Receiver',
                'value'=>function($model)
                {
                    return $model->receiver->getUsernameAndFullname();
                }
            ],
            'datetime',
            ['attribute'=>'Status',
                'value'=>function($model)
                {
                    return $model->statusList()[$model->status];
                }],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
