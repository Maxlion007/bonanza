<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\entities\User\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'attachments')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'author')->textInput() ?>

    <?php // echo $form->field($model, 'chat_id')->textInput() ?>

    <div class="form-group">
        <?php // echo  Html::submitButton('Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo Html::submitButton('Отправить', ['class' =>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
