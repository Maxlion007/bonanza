<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27.08.2017
 * Time: 20:13
 */
use kartik\datetime\DateTimePicker;
use kartik\form\ActiveForm;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="payment-container col-lg-12" id="form" >
    <h2 class="header"><?=Yii::t('app','Fund reservation')?></h2>
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        <label for="model">
            <h3><?=Yii::t('app','Model')?></h3>
            <h4><?=$offer->model->user->getFullName()?></h4>
            <div> <img style="width:300px" src="<?=$offer->model->user->getAvatar()?>" alt="avatar"/></div>
        </label>
        <label for="project">
            <h3><?=Yii::t('app','Project')?></h3>
            <h4><?=$offer->project->name?></h4>
            <h4><?=$offer->project->date_start.' - '.$offer->project->date_finish?></h4>
        </label>
        <!--        <label for="amount">-->
        <!--            Price-->
        <!--            <input type="number" value="price">-->
        <!--        </label>-->
            <button onclick="{copyDatePicker();return false}">Add more date</button>
            <ul id="datepicker"><li>
                    <?php

                    echo $form->field($model,'date_start[]')->widget(DateTimePicker::className(),[
                        'name' => 'date_start',
                        'options' => ['placeholder' => Yii::t('app','Start date'),'onchange'=>"reloadOrder({$offer->id})"],
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-MM-dd HH:mm',
                            'startDate' => $offer->project->date_start,
                            'endDate' => $offer->project->date_finish,
                            'todayHighlight' => true
                        ]
                    ]);
                    echo $form->field($model,'date_finish[]')->widget(DateTimePicker::className(),[
                        'name' => 'date_finish',
                        'options' => ['placeholder' => Yii::t('app','End date'),'onchange'=>"reloadOrder({$offer->id})"],
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-MM-dd HH:mm',
                            'startDate' => $offer->project->date_start,
                            'endDate' => $offer->project->date_finish,
                            'todayHighlight' => true
                        ]
                    ]);
                    ?>
                </li></ul>

            <label for="insurance">
                Insurance
                <input class="reloadOrder" onclick="toggleCheckbox('insurance')" id="insurance" type="checkbox" name="insurance">
            </label>
            <!--        <label for="insurance">-->
            <!--            Lease Clothes-->
            <!--            <input type="checkbox" name="lease_clothes">-->
            <!--        </label>-->


        <select class="reloadOrder" name="currency">
            <?php foreach($currencies as $currency){?>
                <option  value="<?=$currency?>"><?=$currency?></option>
            <?php } ?>
        </select>
<!--<div id="order_container" style="display:none">-->
    <div id="order_container">
    <div id="order">
    </div>
</div>
        <input type="submit" name="submit" value="Pay">
    </div>
    <div class="col-lg-6">

        <?php foreach($model->getCloth() as $category){?>
            <div class="cloth-category col-lg-3">
                <h3><?=$category->name?></h3>
                <?php foreach($category->items as $item){?>
                    <div class="col-lg-2">
                        <h4><?=$item->name?></h4>
                        <img style="width:50px" src="<?=$item->image?>" alt="<?=$item->name?>">
                        <p>Цена: <?=$item->price?></p>
                        <br>
                        Доступные размеры:
                        <ul>
                            <?php foreach($item->sizes as $size){?>
                                <ul><input class="reloadOrder" id ="<?=$size->id?>" name="Cloth[]" type="checkbox" value="<?=$size->id?>"><?=$size->value?></ul>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
    <?php ActiveForm::end()?>


</div>
<script>

    function toggleCheckbox(id)
    {
        if(document.getElementById(id).value==1)
        {
            document.getElementById(id).value='';
        }
        else
        {
//                alert(document.getElementById(id).className);
            document.getElementById(id).value=1;
        }
    }

    //$("#insurance").click(toggleCheckbox('insurance'));

    $( ".reloadOrder" ).change(function() {
        reloadOrder(<?=$offer->id;?>);
    });


    function getInputFields(form_name)
    {
        var form = document.getElementById(form_name);
        var inputs= form.getElementsByTagName("input");
        var textareas= form.getElementsByTagName("textarea");
        var selects = form.getElementsByTagName("select");

        //var_dump(document.getElementById("content"));
        var inputFields = {};//
        inputFields['PaymentForm']={};
        inputFields['Cloth']=[];
        for(var i=0;i<inputs.length;i++){
//            if(inputs[i].value!='' ){

            if(inputs[i].value!='' && inputs[i].name!='submit'){

                if(inputs[i].name.indexOf('PaymentForm')===0)
                {
                    var newName= inputs[i].name.substring(12,inputs[i].name.length-3);//.replace(/['"]+/g,'');
                    inputFields['PaymentForm'][newName]=[inputs[i].value];
                }else
                {
                    if(inputs[i].name.indexOf('Cloth')===0)
                    {
                        if ($("#"+inputs[i].id).is(":checked"))
                        {
                            inputFields['Cloth'].push(inputs[i].value);
                        }

                    }else
                        {
                            inputFields[inputs[i].name]=inputs[i].value;
                        }
                }

            }
        }
        //if there will be textareas in the form, remember that they will be listed last in the array
        for(var i=0;i<textareas.length;i++){
            if(textareas[i].value!=''){inputFields[textareas[i].name]=textareas[i].value;}
        }
        for(var i=0;i<selects.length;i++){
            if(selects[i].value!=''){inputFields[selects[i].name]=selects[i].value;}
        }
        return inputFields;
    }

    function reloadOrder(i)
    {
        var parameters = getInputFields('form');
        $.post("payment?offer_id="+i,
            {parameters:parameters},
            function (data) {
                if(data!=false)
                {
                    document.getElementById('order').innerHTML=data;
                }

            }
        );
    }

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
        document.getElementById("datepicker").appendChild(cln);

//        var itm= document.getElementById("datepicker").lastChild;
//        //var sbj=itm.lastChild;
//        var cln = itm.cloneNode(true);
//        document.getElementById("datepicker").appendChild(cln);
    }
</script>