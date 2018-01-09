<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\GameCondition */

$this->title = 'Create Game Condition';
$this->params['breadcrumbs'][] = ['label' => 'Game Conditions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-condition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
