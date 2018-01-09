<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\Table */

$this->title = 'Update Table: ' . $subject->id;
$this->params['breadcrumbs'][] = ['label' => 'Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $subject->id, 'url' => ['view', 'id' => $subject->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="table-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
