<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model core\entities\User\DateRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="date-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'date_start')->widget(DateTimePicker::className(),[
    'name' => 'date_start',
    'options' => ['placeholder' => Yii::t('app','Start date')],
    'convertFormat' => true,
    'pluginOptions' => [
    'format' => 'yyyy-MM-dd HH:mm',
    'startDate' => strtotime('now'),
    'todayHighlight' => true
    ]
    ]);?>

<?=$form->field($model,'date_finish')->widget(DateTimePicker::className(),[
    'name' => 'date_start',
    'options' => ['placeholder' => Yii::t('app','End date')],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'yyyy-MM-dd HH:mm',
        'startDate' => strtotime('now'),
        'todayHighlight' => true
    ]
])?>

<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
