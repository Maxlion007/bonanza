<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\communication\FriendRequest */

$this->title = 'Create Friend Request';
$this->params['breadcrumbs'][] = ['label' => 'Friend Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
