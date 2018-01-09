<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'Author',
                'value'=>function($model)
                {
                    return $model->author->getUsernameAndFullname();
                }
            ],

            ['attribute'=>'receiver',
                'value'=>function($model)
                {
                    return $model->receiver->getUsernameAndFullname();
                }
            ],

            'message_text:ntext',
            'datetime',
            // 'seen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
