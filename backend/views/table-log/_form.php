<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\entities\infrastructure\TableLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="table-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'table_id')->textInput() ?>

    <?= $form->field($model, 'text')->textInput() ?>

    <?php
    echo $form->field($model,'datetime')->widget(\kartik\widgets\DateTimePicker::className(),[
        'name' => 'datetime',
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'startDate' => strtotime('now'),
            'todayHighlight' => true
        ]
    ])->label(false);;
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
