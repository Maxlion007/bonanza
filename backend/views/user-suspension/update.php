<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $subject core\entities\User\UserSuspension */
/* @var $subject core\forms\User\UserSuspensionForm */
$this->title = 'Update User Suspension: ' . $subject->id;
$this->params['breadcrumbs'][] = ['label' => 'User Suspensions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $subject->id, 'url' => ['view', 'id' => $subject->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-suspension-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $form,
    ]) ?>

</div>
