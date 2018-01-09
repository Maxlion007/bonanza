<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model core\entities\User\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'profit')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList($categories) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"> 
            <?php
                echo $form->field($model,'date_start')->widget(DateTimePicker::className(),[
                    'name' => 'date_start',
                    'options' => ['placeholder' => Yii::t('app','Start date')],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-MM-dd HH:mm:ss',
                        'startDate' => strtotime('now'),
                        'todayHighlight' => true
                    ]
                ]); 
            ?>
        </div>
        <div class="col-md-6">
            <?php 
                echo $form->field($model,'date_finish')->widget(DateTimePicker::className(),[
                    'name' => 'date_finish',
                    'options' => ['placeholder' => Yii::t('app','End date')],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-MM-dd HH:mm:ss',
                        'startDate' => strtotime('now'),
                        'todayHighlight' => true
                    ]
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6"> 
            <?= $form->field($model, 'closed')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12"> 
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
   

    <?php ActiveForm::end(); ?>

</div>
