<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\Table */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-view">

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
            'id',
            'datetime_start',
            'datetime_end',
            'game_name',
            'started',
            'closed',
            'owner_id',
            'winner_id',
            'bank',
        ],
    ]) ?>

    <div class="col-md-6">

        <div class="box box-default">
            <div class="box-header with-border">Characteristics</div>
            <div class="box-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => array_map(function (\core\entities\infrastructure\ConditionValue $value) {
                        return [
                            'label' => $value->condition->name,
                            'value' => $value->value,
                        ];
                    }, $model->values),
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="box box-default">
            <div class="box-header with-border">Logs</div>
            <div class="box-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => array_map(function (\core\entities\infrastructure\TableLog $log) {
                        return [
                            'label' => $log->datetime,
                            'value' => $log->text,
                        ];
                    }, $model->logs),
                ]) ?>
            </div>
        </div>
    </div>
</div>
