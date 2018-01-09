<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\forms\search\TableSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="table-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'datetime_start') ?>

    <?= $form->field($model, 'datetime_end') ?>

    <?= $form->field($model, 'game_name') ?>

    <?= $form->field($model, 'min_balance') ?>

    <?php // echo $form->field($model, 'started') ?>

    <?php // echo $form->field($model, 'closed') ?>

    <?php // echo $form->field($model, 'owner_id') ?>

    <?php // echo $form->field($model, 'bet') ?>

    <?php // echo $form->field($model, 'turn_time') ?>

    <?php // echo $form->field($model, 'max_player_number') ?>

    <?php // echo $form->field($model, 'additional_conditions') ?>

    <?php // echo $form->field($model, 'winner_id') ?>

    <?php // echo $form->field($model, 'bank') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
