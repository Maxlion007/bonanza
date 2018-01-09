<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\datetime\DateTimePicker;
use yii\widgets\LinkPager;

$this->title = Yii::t('app','Find model');
?>
<style>
    .model_pick
    {
        position:absolute;
        top:0px;
        right:0px;
        height: 20px;
        width: 20px;
        background: #ecceac;
        border: 1px solid #ecceac;
    }

    #datepicker li
    {
/*        border:1px solid #ecceac;*/
        border-radius:3px;
    }
    .chosen
    {
        background-color: #fff0f0 !important;
    }
    .country
    {
        position: fixed;
        width:100%;
        height:100%;
        z-index:99;
        top:0px;
        left:0px;
    }
</style>
<section id="search">
    <!--    <div class="country visible">-->
    <!--    <div class="choose">-->
    <!--        <h1>Выбор страны</h1>-->
    <!--        <div class="russia">-->
    <!--            <a onclick="chooseCountry('Россия')" href="#">Россия</a>-->
    <!--        </div>-->
    <!--        <div class="italia">-->
    <!--            <a onclick="chooseCountry('Испания')" href="#">Испания</a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    </div>-->
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <?php $form=ActiveForm::begin();?>

                <div class="row">
                    <div class="col-sm-12">
                        <?php if($user->twoLevel()){
                            ?>

                            <div id="modal_job_offer">
                                <h2><?=Yii::t('app','Make offer')?></h2>
                                <?php $offerForm=ActiveForm::begin(['action' =>['offer/create-all'], 'method' => 'post',]);?>
                                <?php echo $offerForm->field($offermodel, 'project_id')->dropDownList($projects); ?>

                                <?php echo $offerForm->field($offermodel, 'message')->textarea(['rows' => 6]) ?>

                                <div class="chosen_models" id="chosen_models">
                                    <h2><?=Yii::t('app','Following models will receive this offer')?>:</h2>
                                    <h6><?php echo Yii::t('app',"Make sure the models you make offer work in the same category as your project");?></h6>
                                    <?php
                                    if(count($chosen)>0)
                                    {
                                        foreach($chosen as $ch)
                                        {
                                            ?>
                                            <div>
                                                <?=$ch->first_name.' '.$ch->last_name;?>
                                                <?php echo Yii::t('app','Works with: ');?>
                                                <?=$ch->getCategoriesNames();?>
                                                <button id="<?=$ch->id?>" onclick="actionChosen(this.getAttribute('id'))">&times;</button>
                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php echo Html::submitButton(Yii::t('app','Make offer'), ['class' => 'btn btn-success']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>

                            <?php

                        }else{?>
                            <p><?=Yii::t('app','You need to complete your Level Two Registration and receive confirmation from administrator to be able to make offers')?></p>
                        <?php }?>
                    </div>
                </div>


                <h3><?=Yii::t('app','Find model')?></h3>
                <div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'city')->textInput(['maxLength' => true]); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-sm-6">

                            <?= $form->field($model, 'categories')->dropDownList($categories
                            ); ?>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn" onclick="{copyDatePicker();return false}">Add more date</button>
                            <button class="btn" onclick="{deleteDatePicker();return false}">Delete date</button>
                            <ul id="datepicker"><li>
                                    <?php
                                    if(Yii::$app->request->post() && !empty($model->date))
                                    {

                                        ?><h3><?=Yii::t('app','Chosen dates')?>:</h3><ul><?php
                                        foreach($model->date as $d)
                                        {
                                            if(isset($d['start']) && $d['start'])
                                            {
                                                ?><li><?=Yii::t('app','Start date')?>:<?=$d['start'];?></li>
                                                <?php
                                            }
                                            if(isset($d['end']) && $d['end'])
                                            {
                                                ?><li><?=Yii::t('app','End date')?>:<?=$d['end'];?></li>
                                                <?php
                                            }

                                        }
                                        ?>
                                    </ul>
                                        <?php
                                    }

                                    echo $form->field($model,'date_start[]')->widget(DateTimePicker::className(),[
                                        'name' => 'date_start',
                                        'value'=> '2017-08-31 00:00:00',
                                        'options' => ['placeholder' => Yii::t('app','Start date')],
                                        'convertFormat' => true,
                                        'pluginOptions' => [
                                            'format' => 'yyyy-MM-dd HH:mm:ss',
                                            'startDate' => strtotime('now'),
                                            'todayHighlight' => true
                                        ]
                                    ]);
                                    echo $form->field($model,'date_finish[]')->widget(DateTimePicker::className(),[
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
                                </li></ul>
                        </div>
                    </div>
                </div>
                <hr>

                <h3>Параметры модели</h3>
                <div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="check">
                                <?= $form->field($model,'favourite')->checkbox() ?>
                            </div>
                            <?php if($favourites==0){?>
                                <p class="red">
                                    <?=Yii::t('app','You have no favourite models. You can add models to favourites after finishing a project with them.')?>
                                </p>
                            <?php }?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Возраст</label>
                            <div class="row">
                                <div class="col-sm-5">
                                    <?= $form->field($model, 'age_from')->dropDownList($traits['age']['variants'])->label(false); ?>
                                </div>
                                <div class="col-sm-2"><span class="vertical">до</span></div>
                                <div class="col-sm-5">
                                    <?= $form->field($model, 'age_to')->dropDownList($traits['age']['variants'])->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach($traits as $key=>$trait)
                        {

                            if($key!=='age' && $trait->slug!=='country' && $trait->slug != 'hair_unnatural')
                            {
                                if($trait->type=='boolean')
                                {
                                    ?>
                                    <div class="col-sm-6">
                                        <div class="check"><input type="checkbox" id="<?=$trait->slug;?>" name="characteristics[<?=$key?>]" <?php if(isset($model->characteristics[$key]) && $model->characteristics[$key]!=null){echo ' selected';}?>> <label for="<?=$trait->slug;?>"><?=$trait->name;?></label>
                                        </div>   
                                    </div>
                                    <?php
                                }else
                                {
                                    if(count($trait->variants)>1 ) {
                                        ?>
                                        <div class="col-sm-6">
                                            <label><?=$trait->name;?></label>
                                            <select
                                                <?php if ($trait->type == 'multiple'){echo ' name="characteristics['.$key.'][]" multiple';}else{echo "name=\"characteristics[".$key."]\"";}?>
                                            >
                                                <?php

                                                foreach($trait->variants as $variant){
                                                    ?>
                                                    <option value='<?=$variant?>'
                                                        <?php

                                                        if(
                                                            (isset($_GET['country']) && $_GET['country'])
                                                            && !(isset(Yii::$app->request->post()['SearchModelForm']['characteristics']['country'])
                                                                && Yii::$app->request->post()['SearchModelForm']['characteristics']['country'])
                                                            && $variant==$_GET['country']
                                                        ){echo ' selected';}

                                                        if($_POST && isset($model->characteristics[$key]))
                                                        {
                                                            if(is_array($model->characteristics[$key]) && in_array($variant,$model->characteristics[$key])
                                                            )
                                                            {
                                                                echo ' selected';
                                                            }elseif((is_string($model->characteristics[$key]) && $variant==$model->characteristics[$key])
                                                                 )
                                                            {
                                                                echo ' selected';
                                                            }
                                                        }?> >
                                                        <?=$variant?> </option>";
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="col-sm-6"><label><?=$trait->name;?></label> <input type="text" name="characteristics[<?=$key?>]" <?php if(isset($_POST['SearchModelForm'][$key]) && isset($model->characteristics[$key]) && $model->characteristics[$key]!=null){echo ' value="'.$model->characteristics[$key].'"';}?>>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }

                        ?>
                    </div>
                </div>
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Отправить'),['class'=>'btn']); ?>
                <div>
                    <button class="btn"><?=Yii::t('app','Reset filter')?></button>
                </div>
                <?php ActiveForm::end(); ?>
                <hr>
            </div>

            <div class="col-sm-5">
                <?php Pjax::begin();?>
                <h3>Результаты</h3>
                <div class="row">
                    <?php
                    if(is_array($result))
                    {
                        foreach($result as $record)
                        {?>
                            <div class="col-md-6 col-xs-6">
                                <div class="item" style="position:relative">
                                    <button data-id="<?=$record->id?>" class="model_pick <?php if(isset($_SESSION['chosen_models']) && is_array($_SESSION['chosen_models']) && in_array($record->id,$_SESSION['chosen_models'])){echo " chosen";}?>"></button>
                                    <div class="title"><?=$record->first_name.' '.$record->last_name;?> <span><?= \common\widgets\WOnline::widget(['user_id' => $record->user->id]); ?></span></div>
                                    <div class="info">
                                        <?php if(isset($record->categories[0]->name)){echo $record->categories[0]->name;};?> <span><?=$record->address;?></span>
                                    </div>
                                    <div class="info">
                                        <span><?=$record->prices?></span>
                                    </div>

                                    <div class="image-block">
                                            <img src="<?=Html::encode($record->user->getAvatar());?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php echo LinkPager::widget(['pagination'=>$pagination])?>
                <?php Pjax::end();?>
            </div>
        </div>
    </div>
</section>
<script>
    function chooseCountry(country)
    {
        var block=document.getElementsByClassName('country')[0];
        block.style.display="none";
        var select=document.getElementsByClassName('country-picker')[0];
        for (i = 0; i < select.length; i++) {
            if(select.options[i].value==country)
            {
                select.options[i].selected=true;
            }
        }
    }


//     function actionChosen(id)
//     {
//         $.post("chosen",
//             {'id':id},
//             function (data) {
//                 $('#chosen_models').load(document.URL +  ' #chosen_models');
//             }

//         );
//         toggleChosen(id);
// //        $('#chosen_models').load(document.URL +  ' #chosen_models');
//     }

        $('.model_pick').click(function()
            {
              $.post("chosen",
                    {'id':$(this).attr('data-id')},
                    function (data) {
                        $('#chosen_models').load(document.URL +  ' #chosen_models');
                        console.log(data);
                    }

                );
                $(this).toggleClass(' chosen');
            });

    function var_dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        console.log(out);
    }

    function copyDatePicker()
    {
        var itm = document.getElementById("datepicker").lastChild;
        var cln = itm.cloneNode(true);
        var_dump(cln);

        document.getElementById("datepicker").appendChild(cln);

//        var itm= document.getElementById("datepicker").lastChild;
//        //var sbj=itm.lastChild;
//        var cln = itm.cloneNode(true);
//        document.getElementById("datepicker").appendChild(cln);
    }

    function deleteDatePicker()
    {
        var first = document.getElementById("datepicker").firstChild;
        var last = document.getElementById("datepicker").lastChild;
        if( first !== last ) {
            last.remove();
        }
    }


    // function toggleChosen(data_id)
    // {
    //     var all= document.getElementsByClassName('model_pick');
    //     var element=false;

    //     for(var i=0; i<all.length;i++)
    //     {
    //         if(all[i].getAttribute('data-id')==data_id)
    //         {
    //             var pos=all[i].className.indexOf('chosen');
    //             if(pos<=0)
    //             {
    //                 pos.className+=' chosen';
    //             }
    //             else
    //             {
    //                     alert(all[i].className);
    //                 pos.className=all[i].className.substring(0,pos-1);
    //             }
    //         }
    //     }

    // }
    /*
    function toggleChosen(id)
    {
        var pos = document.getElementByAt
        var pos=document.getElementById(id).className.indexOf('chosen');
        if(pos<=0)
        {
            document.getElementById(id).className+=' chosen';
        }
        else
        {
            document.getElementById(id).className=document.getElementById(id).className.substring(0,pos-1);
        }
    }
*/

</script>