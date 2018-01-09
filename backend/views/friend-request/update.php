<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\communication\FriendRequest */

$this->title = 'Update Friend Request: ' . $model->sender_id.'-'.$model->receiver_id;
$this->params['breadcrumbs'][] = ['label' => 'Friend Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sender_id.'-'.$model->receiver_id, 'url' => ['view', 'sender_id' => $model->sender_id,'receiver_id'=>$model->receiver_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="friend-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
