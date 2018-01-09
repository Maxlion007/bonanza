<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\ConditionValue */

$this->title = 'Create Condition Value';
$this->params['breadcrumbs'][] = ['label' => 'Condition Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="condition-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
