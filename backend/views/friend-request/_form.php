<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\entities\communication\FriendRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="friend-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sender_id')->dropDownList($model->prepareUsers()) ?>

    <?= $form->field($model, 'receiver_id')->dropDownList($model->prepareUsers()) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
