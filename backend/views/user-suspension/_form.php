<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\helpers\UserHelper;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model core\entities\User\UserSuspension */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-suspension-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(UserHelper::prepareBothNamesList()) ?>

    <?=$model->attributeLabels()['datetime_end']?>
    <?php
    echo $form->field($model,'datetime_end')->widget(DateTimePicker::className(),[
        'name' => 'datetime_end',
        'options' => ['placeholder' =>'When ban ends'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'startDate' => strtotime('now'),
            'todayHighlight' => true
        ]
    ])->label(false);;
    ?>
    <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
