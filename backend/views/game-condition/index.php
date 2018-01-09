<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\GameConditionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Game Conditions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-condition-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Game Condition', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'slug',
            'type',
            'required',
            // 'default',
            // 'variants_json:ntext',
            // 'sort',
            // 'for_fool',
            // 'for_poker',
            // 'for_seka',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
