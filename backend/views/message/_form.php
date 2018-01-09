<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model core\entities\communication\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_id')->dropDownList($model->prepareUsers()) ?>

    <?= $form->field($model, 'receiver_id')->dropDownList($model->prepareUsers()) ?>

    <?= $form->field($model, 'message_text')->textarea(['rows' => 6]) ?>

    <?=$model->attributeLabels()['datetime']?>
    <?php
    echo $form->field($model,'datetime')->widget(DateTimePicker::className(),[
        'name' => 'datetime',
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'startDate' => strtotime('now'),
            'todayHighlight' => true
        ]
    ])->label(false);;
    ?>

    <?= $form->field($model, 'seen')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
