<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model core\forms\infrastructure\TableForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="table-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model,'datetime_start')->widget(DateTimePicker::className(),[
        'name' => 'datetime_start',
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'startDate' => strtotime('now'),
            'todayHighlight' => true
        ]
    ])->label(false);;
    ?>


    <?php
    echo $form->field($model,'datetime_end')->widget(DateTimePicker::className(),[
        'name' => 'datetime_end',
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'startDate' => strtotime('now'),
            'todayHighlight' => true
        ]
    ])->label(false);;
    ?>


    <?= $form->field($model, 'game_name')->textInput() ?>

    <?= $form->field($model, 'started')->checkbox() ?>

    <?= $form->field($model, 'closed')->checkbox() ?>

    <?= $form->field($model, 'owner_id')->dropDownList($model->prepareUsers()) ?>

    <?= $form->field($model, 'winner_id')->dropDownList($model->prepareUsers()) ?>

    <?= $form->field($model, 'bank')->textInput() ?>

    <div class="box box-default">
        <div class="box-header with-border">Characteristics</div>
        <div class="box-body">
            <?php foreach ($model->values as $i => $value){ ?>
                <?php if ($variants = $value->variantsList()){ ?>
                    <?= $form->field($value, '[' . $i . ']value')->dropDownList($variants, ['prompt' => '']) ?>
                <?php }else{
                    if($value->getType()=='boolean'){
                    ?>
                    <?= $form->field($value, '[' . $i . ']value')->checkbox() ?>
                        <?php }else{ ?>
                    <?= $form->field($value, '[' . $i . ']value')->textInput() ?>
                <?php }
                } ?>
            <?php } ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
