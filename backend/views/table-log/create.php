<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\TableLog */

$this->title = 'Create Table Log';
$this->params['breadcrumbs'][] = ['label' => 'Table Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
