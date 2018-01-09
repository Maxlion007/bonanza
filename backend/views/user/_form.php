<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
use core\helpers\CountryHelper;
use core\helpers\UserHelper;
/* @var $this yii\web\View */
/* @var $model core\entities\User\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList($model->prepareGenders()) ?>

    <?php // $form->field($model, 'birthday')->textInput() ?>
    <?=$model->attributeLabels()['birthday']?>
    <?php
    echo $form->field($model,'birthday')->widget(DatePicker::className(),[
        'name' => 'birthday',
        'options' => ['placeholder' =>'Birthday'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd',
            'todayHighlight' => true
        ]
    ])->label(false);;
    ?>
    <?= $form->field($model, 'country_id')->dropDownList(CountryHelper::prepareCountries()) ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'wallet')->textInput() ?>

    <?= $form->field($model, 'played_games')->textInput() ?>

    <?= $form->field($model, 'avatar_id')->textInput(['maxlength' => true]) ?>

    <div class="box box-default">
        <div class="box-header with-border">Photo</div>
        <div class="box-body">
            <?php echo $form->field($model->photos, 'files[]')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*'
                ]
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' =>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
