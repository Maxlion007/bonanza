<?php

use yii\helpers\Html;
use yii\grid\GridView;
use core\helpers\GameHelper;
/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\TableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tables';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="table-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-xs-2 modal" id="choose_game_modal" style="height:160px; left:25%;top:13%">
        <div class="container">
            <p style="color:white">Choose game name</p>
            <p>
                <?= Html::a('Create Fool Table', ['create','game_name'=>GameHelper::GAME_FOOL], ['class' => 'btn btn-success']) ?>
            </p>
            <p>
                <?= Html::a('Create Poker Table', ['create','game_name'=>GameHelper::GAME_POKER], ['class' => 'btn btn-success']) ?>
            </p>
            <p>
                <?= Html::a('Create Seka Table', ['create','game_name'=>GameHelper::GAME_SEKA], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
    <p>
        <?= Html::button('Create Table', ['class' => 'btn btn-success','id'=>'create_table_button']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'datetime_start',
            'datetime_end',
            'game_name',
            // 'started',
            // 'closed',
            // 'owner_id',
            // 'winner_id',
            // 'bank',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>
    $(document).ready(function(){    $('#create_table_button').on('click', function(){
        $('#choose_game_modal').toggleClass("visible");
    });
        });
</script>