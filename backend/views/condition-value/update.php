<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\ConditionValue */

$this->title = 'Update Condition Value: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Condition Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="condition-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
