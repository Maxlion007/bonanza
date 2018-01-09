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
    <?php echo $form->field($model->model, 'first_name')->textInput(['maxLength' => true]); ?>
    <?php echo $form->field($model->model, 'last_name')->textInput(['maxLength' => true]); ?>

    <?php echo $form->field($model, 'email')->textInput(['maxLength' => true]); ?>
    <?php echo $form->field($model, 'phone')->textInput(['maxLength' => true]); ?>

    <?= $form->field($model, 'avatar')->fileInput(['placeholder' => $model->getAttributeLabel('avatar')]); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <?php echo $form->field($model->model, 'insurance_number')->textInput(['maxLength' => true]); ?>
                    <?php echo $form->field($model->model, 'bank_account_number')->textInput(['maxLength' => true]); ?>
                    <?php echo $form->field($model->model, 'description')->textInput(['maxLength' => true]); ?>
                    <?php echo $form->field($model->model, 'address')->textInput(['maxLength' => true]); ?>
<!--                    --><?php //echo $form->field($model->model, 'agree_to_communicate')->checkbox(['maxLength' => true]); ?>
<!--                    --><?php //echo $form->field($model->model, 'agree_to_show_locations')->checkbox(['maxLength' => true]); ?>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-body">
                    <?php
                    foreach($model->characteristics->characteristics as $key=>$trait)
                    {
                        ?>


                        <?php
                        if($trait->type=='boolean')
                        {
                            ?>
                            <div><label><?=$trait->name?></label><input type="checkbox" name="CharacteristicsForm[characteristics][<?=$key?>]" <?php if(isset($user->model->characteristics[$key]) && $user->model->characteristics[$key])
                            {
                                echo " checked";
                            }
                            ?>
                                >
                            </div>
                            <?php
                        }else
                        {
//                            var_dump($user->model->characteristics);
//                            die();
                            if(count($trait->variants)>1) {
                                    ?>
                                    <div class="col-sm-6">
                                        <label><?=$trait->name?></label>
                                        <select
                                        <?php if ($trait->type == 'multiple'){echo " name=\"CharacteristicsForm[characteristics][$key][]\" multiple";}else{echo "name=\"CharacteristicsForm[characteristics][$key]\"";}?>
                                    >
                                            <?php foreach($trait->variants as $variant){?>
                                        <option <?php echo "value='$variant'";
                                                if(isset($user->model->characteristics[$key])
                                                    && $variant==$user->model->characteristics[$key]){
                                                    echo 'selected';}
                                                echo ">$variant </option>";
                                             } ?>
                                        </select>
                                    </div>
                                    <?php
                            }
                            else
                            {
                                ?>
                                <div class="col-sm-6"> <label><?=$trait->name?></label><input type="text" name="CharacteristicsForm[characteristics][<?=$key?>]" value="<?php if(isset($user->model->characteristics[$key])){echo $user->model->characteristics[$key];}?>">
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

                    <div class="col-sm-6">

                        <select name="categories[]" multiple>
                                <?php
                                foreach($model->categories as $id=>$category){?>
                                    <option <?php echo "value='$id'";
                                    if(is_array($chosen_categories) && !empty($chosen_categories) && in_array($category,$chosen_categories)){echo 'selected';}
                                    echo ">$category </option>";
                                } ?>
                            </select>

                    </iv>

                </div>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

