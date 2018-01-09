<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\User\DateRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title='Create Date Event';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .summary
    {
        display: none !important;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class="date-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create-date'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'description',
            'date_start',
            'date_finish',

            [
                'label'=>'Actions',
                'format'=>'raw',
                'value'=>function ($data) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['cabinet/model/update-date', 'date_id' => $data->id]).Html::a('<span class="glyphicon glyphicon-trash"></span>', ['cabinet/model/delete-date', 'date_id' => $data->id]);
                },
            ],
        ],
    ]); ?>
</div>
