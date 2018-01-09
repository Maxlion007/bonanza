<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\forms\infrastructure\GameConditionForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-condition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($model->typesList()) ?>

    <?= $form->field($model, 'required')->checkbox() ?>

    <?= $form->field($model, 'default')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'textVariants')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'for_fool')->checkbox() ?>

    <?= $form->field($model, 'for_poker')->checkbox() ?>

    <?= $form->field($model, 'for_seka')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
