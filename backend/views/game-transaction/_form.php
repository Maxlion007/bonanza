<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model core\entities\transactions\GameTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($model->prepareUsers()) ?>

    <?= $form->field($model, 'table_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
