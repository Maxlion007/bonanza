<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\User\DateRecord */

$this->title = 'Create Date Record';
$this->params['breadcrumbs'][] = ['label' => 'Date Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="date-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
