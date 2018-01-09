<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\FileInput;
use core\helpers\CountryHelper;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
   jQuery(function($){
   $("#phone").mask("+38(999) 999-99-99");
   });
</script>
<script src="./js/maskedinput.js"></script>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['id'=>'phone','maxlength' => true]) ?>

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
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
