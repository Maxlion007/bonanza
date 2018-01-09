<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\communication\FriendRequest */

$this->title = $model->sender_id.'-'.$model->receiver_id;
$this->params['breadcrumbs'][] = ['label' => 'Friend Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sender_id' => $model->sender_id, 'receiver_id'=>$model->receiver_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sender_id' => $model->sender_id, 'receiver_id'=>$model->receiver_id], [
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
            ['attribute'=>'Sender',
                'value'=>function($model)
                {
                    return $model->sender->getUsernameAndFullname();
                }
            ],

            ['attribute'=>'receiver',
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
        ],
    ]) ?>

</div>
