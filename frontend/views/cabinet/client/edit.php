<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 23.06.17
 * Time: 13:49
 */
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

$this->title = 'Edit Profile';

?>
<div class="container">
    <?php $form = ActiveForm::begin(); ?>
    
    <h2><i class="icon">build</i> Редактирование профиля</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <?= $form->field($model, 'email')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model, 'phone')->textInput(['maxLength' => true, 'class' => 'phone']); ?>
                    <?= $form->field($model, 'logo')->fileInput(); ?>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <?= $form->field($model->client, 'contact_face')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'organization')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'pravo_form')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'field_of_specialisation')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'work_phone')->textInput(['maxLength' => true, 'class' => 'phone']); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <?= $form->field($model->client, 'inn')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'social_insurance')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'address')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'zip_code')->textInput(['maxLength' => true]); ?>
                    <?= $form->field($model->client, 'bank_account_number')->textInput(['maxLength' => true]); ?>
                </div>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

