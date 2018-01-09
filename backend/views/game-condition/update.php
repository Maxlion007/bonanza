<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\GameCondition */

$this->title = 'Update Game Condition: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Game Conditions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="game-condition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $form,
    ]) ?>

</div>
