<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\UserSuspensionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Suspensions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-suspension-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Suspension', ['create'], ['class' => 'btn btn-success']) ?>
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

            'datetime_end',
            'reason:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
