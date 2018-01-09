<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model core\entities\User\Chat */

$this->title = "Чат";
$this->params['breadcrumbs'][] = ['label' => 'Chats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .icon
    {
        color: black;
        z-index:99;
    }
    </style>
<link rel="stylesheet" href="/assets/css/main.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--[if lt IE 9]>
<script src="/assets/js/ie/html5shiv.min.js"></script>
<script src="/assets/js/ie/respond.min.js"></script>
<![endif]-->
<script src="/assets/js/main.js"></script>
<script src="/assets/js/libs/jquery.magnific-popup.min.js"></script>


<div class="chat-view">
    <div id="chat" class="">
        <div class="chat-content">
            <div class="panel">
                <div class="title toggle-open"><i class="icon visible-xs-inline-block">expand_more</i> Проекты в работе</div>
                <div class="toggle">

                    <ul>
                        <?php
                        foreach($user->chats as $project_chat)
                        {
                            ?>
                            <li>
                                <div class="row">
                                    <a href="/cabinet/chat?id=<?=$project_chat->id?>" />
                                    <div class="col-xs-3">
                                        <div class="image-block">
                                            <img src="<?php echo $project_chat->order->project->logo;?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <b><?=$project_chat->order->project->name;?></b> <i class="icon new">fiber_new</i>
                                    </div>
                                </div>
                            </li>

                            <?php
                        }?>
                    </ul>
                    <div class="status">
                        <?php
                        if(is_array($assignments) && !empty($assignments) && !$model->closed)
                        {
                            foreach($assignments as $assignment){

                                if($assignment['assignment']->status===0){?>

                                    <?=$assignment['model']?>:
                                    <div class="checkbox">
                                        <a type="radio" name="project-status" id="status-project-1" href="/cabinet/chat/complete?id=<?=$model->id?>&status=2">
                                            <label for="status-project-1">Работа выполнена</label></a>
                                    </div>
                                    <div class="checkbox red">
                                        <a type="radio" name="project-status" id="status-project-2" href="/cabinet/chat/complete?id=<?=$model->id?>&status=1">
                                            <label for="status-project-2">Работа не выполнена</label></a>
                                    </div>
                                <?php }
                            }
                            ?>
                            <p>
                                Одобряйте работу только после ее исполнения.
                            </p>
                            <a type="button" href="#">Отменить проект</a>
<!--                            <div class="check">-->
<!--                                <input type="checkbox" id="cancel-client">-->
<!--                                <label for="cancel-client">Проект отменен по инициативе клиента</label>-->
<!--                            </div>-->


                            <?php
                        }else{?>
                            <h3>Чат закрыт</h3>

                        <?php }
                        ?>
                    </div>
                </div>
            </div>

    <div id="test">
        <?php if(!empty($model)){?>
            <div class="messages" id="messages">
                <div class="title"><b>Проект:</b> <?=$model->order->project->name?></div>
                <div class="content">
                    <div class="people">
                        <span>Участники чата</span>
                        <?php foreach($model->getMembers() as $member){?>
                            <a href="<?php
                            if($member->isClient())
                            {
                                echo "/cabinet/client/{$member->client->id}";
                            }
                            elseif($member->isModel())
                            {
                                echo "/cabinet/model/{$member->model->id}";
                            }
                            ?>"><img src="<?=$member->getAvatar()?>" alt="<?php if($member->isModel()){echo $member->model->first_name;}elseif($member->isClient()){echo $member->client->contact_face;}?>"></a>
                        <?php } ?>
                    </div>

                    <div id="message_window">
                        <?php Pjax::begin();?>

                        <div id="pos"></div>
                        <ul id="message_list">
                            <!--    <script>-->
                            <!--        console.log(sessionStorage.scrollTop);-->
                            <!--        document.getElementById('message_window').scrollTop=sessionStorage.scrollTop;-->
                            <!--        </script>-->
                            <?php
                            if(count($model->messages)>0){
                                $messages=$model->messages;
                                ArrayHelper::multisort($messages, 'date', SORT_DESC);
                                foreach($messages as $message){
                                    ?>
                                    <li <?php if ($message->user->id==Yii::$app->user->identity->getId()){ echo 'class="reply"';}?>>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-3">
                                                <a href="#" class="name">
                                                    <div class="image-block">
                                                        <img src="<?=$message->user->getAvatar()?>" alt="Avatar">
                                                    </div>
                                                    <span>
                                            <?=$message->user->getName();
                                            ?></span>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 col-xs-9">
                                                <div class="text">
                                                    <?=$message->text;?>
                                                </div>
                                                <div>
                                                    <?php foreach($message->attachments as $attachment)
                                                    {
                                                        ?>
                                                        <a href="<?='../../'.$attachment->file?>" download="<?=$attachment->file?>"><?=$attachment->file?></a>
                                                        <?php
                                                    }?>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="time">
                                                    <?=$message->date?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php }
                            }
                            else
                            {
                                echo "В чате ещё нет сообщений.";
                            } ?>
                        </ul>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
                <?php $form = ActiveForm::begin();?>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="write-message" style="position: relative">
                            <?= $form->field($messagemodel, 'text')->textarea(['rows' => 6,'placeholder' => 'Введите Ваше сообщение','style'=>'position:absolute; bottom: -90px;'])->label(false) ?>
                            <?= $form->field($uploadmodel, 'files[]')->fileInput(['multiple' => true,'style'=>'position:absolute; bottom: -90px;']) ?>
                            <!--                                <a class="link" href="/recall-client.html" type="submit"><i class="icon">send</i></a>-->
                            <?php echo Html::submitButton('<i class="icon">send</i>', ['class' =>'link btn btn-success','style'=>'position: absolute;right: 0%;top: 25%;']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end()?>
            </div>
        <?php } ?>
    </div>
        </div>
    </div>
</div>

<script>


//    $(document).ready(function() {
//
//    }

    function getCurrentHeight()
    {
        var eachHeight = 0;

        $('#message_list li').each(function(_i, item) {
            eachHeight += $(item).outerHeight();
        });
        return eachHeight;
    }

function scrollPos() {
        return $('#message_list').scrollTop();
        //console.log(sessionStorage.scrollTop);
    }

    setInterval(function () {
//        console.log(scrollPos());
        var currentHeight=getCurrentHeight();
        if(scrollPos()<250) {
        pos = scrollPos();
            $('#message_window').load(window.location.href + " #message_list");
            $('#message_list').scrollTop(currentHeight);
        }
    }, 10000);

    </script>