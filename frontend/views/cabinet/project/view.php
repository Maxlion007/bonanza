<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\User\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view" style="text-align: center; margin: 0 5% 0 5%;">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'client_id',
            'name',
            'description',
            'profit',
            'date_start',
            'date_finish',
            ['attribute'=>'category_id',
                'value'=>function($model)
                {
                    return $model->category->name;
                }],
            'closed',
        ],
    ]) ?>
    <style>
        .participant
        {
            border:1px solid #ecceac;
            margin:3px;
            float:left;
        }
    </style>
    <h2>Модели-учасники:</h2>
    <div class="container">
        <?php
        foreach($models_assigned as $participant)
        { ?>
            <div class="participant">
        <a href='#'><?=$participant->first_name.' '.$participant->last_name?></a>
        <?=Html::a('X', ['delete-assignment', 'id' => $participant->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);?>
            </div>
<?php } ?>
        </div>
</div>
