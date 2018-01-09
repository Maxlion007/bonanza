<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="review-index">

    <div class="review-create">
        <?php
        $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?=Yii::t('app','Leave your mark(required)')?>:
            <?=$form->field($model, 'rating')->dropDownList(['5'=>'5','4'=>'4','3'=>'3','2'=>'2','1'=>'1']) ?>
            <?=Yii::t('app','Leave your review')?>:
            <?=$form->field($model, 'message')->textInput() ?>
            <?=$form->field($model,'project')->dropDownList($assignments);?>
            <?= Html::submitButton(Yii::t('app','Send'), ['class' =>'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>