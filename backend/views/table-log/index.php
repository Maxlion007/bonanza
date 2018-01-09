<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\TableLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Table Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Table Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'table_id',
            'text',
            'datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
