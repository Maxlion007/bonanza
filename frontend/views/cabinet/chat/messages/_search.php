<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\entities\User\MessageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo  $form->field($model, 'id') ?>

    <?php echo  $form->field($model, 'text') ?>

    <?php echo  $form->field($model, 'date') ?>

    <?php //echo  $form->field($model, 'attachments') ?>

    <?php echo  $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'chat_id') ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
