<?php
use yii\helpers\Html;
use yii\helpers\Url;
use core\forms\transactions\UserTransactionForm;
use core\forms\communication\MessageForm;
use yii\bootstrap\ActiveForm;
$messageModel=new MessageForm();
$transactionModel=new UserTransactionForm()
?>

<aside class="main-sidebar">
<style>
    h2,h3,h4,p
    {
        color:white;
    }
    .visible
    {
        display:block !important;
    }
    .modal
    {
        /*display: block;*/
        display:none;
        position:absolute;
        background-color: black;
        opacity: 1;
        top:25%;
        left:100%;
        width:400px;
        height:300px;
        border:1px solid black;
        z-index=99;
    }
    </style>
    <section class="sidebar">
    <div id="messages">
        <h3>Messages</h3>
        <div>
            <div>
                <h4>Received</h4>
                <?php foreach($user->receivedMessages as $message){?>
                    <div class="col-xs-12">
                        <p><?=$message->author->fullname?></p>
                        <p><?=$message->datetime?></p>
                        <p><?=$message->message_text?></p>
                    </div>
                <?php } ?>
            </div>
            <div>
                <h4>Sent</h4>
                <?php foreach($user->sentMessages as $message){?>
                    <div class="col-xs-12">
                        <p><?=$message->author->fullname?></p>
                        <p><?=$message->datetime?></p>
                        <p><?=$message->message_text?></p>
                    </div>
                <?php } ?>
            </div>
            <div>
                <button id="new-message-btn" class="btn btn-info">New message</button>
            </div>
            <div class="modal message-form" id="new-message-container">
                <?php $form=ActiveForm::begin(['action'=>Url::toRoute(['/cabinet/message/send-message']),'method'=>'post']);?>
                    <?= $form->field($messageModel, 'receiver_id')->dropDownList($messageModel->prepareUsers()) ?>
                    <?= $form->field($messageModel, 'message_text')->textarea() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
        <hr>

        <div id="friends">
            <h3>Friends</h3>
            <div>
                <h4>Friend Requests</h4>
                <?php foreach($user->pendingReceivedFriendRequests as $request){?>
                    <div class="col-xs-12">
                        <p><?=$request->sender->fullname?></p>
                        <div id="request_actions">
                            <?=Html::a('V',Url::toRoute(['cabinet/friend-request/accept', 'receiver_id' => $request->receiver_id]),['class'=>'green_text'])?>
                            <?=Html::a('X',Url::toRoute(['cabinet/friend-request/reject', 'receiver_id' => $request->receiver_id]),['class'=>'red_text'])?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div>
                <h4>Friends</h4>
                <?php foreach($user->friends as $friend){?>
                    <div class="col-xs-12">
                        <p><?=$friend->username?></p>
                    </div>
                <?php } ?>
            </div>
            <div id="user-search-contained">
                <input id="user-search" type="text"/>
            </div>
            <div id="search-suggestions-container">

            </div>
        </div>
        <hr>

        <div id="Games">
            <h3>Games</h3>
        </div>
        <hr>

        <div id="Transactions">
            <h3>Transactions</h3>
            <div>
                <h3>Received Transactions</h3>
                <div>
                    <?php foreach($user->receivedTransactions as $received){?>
                        <div class="col-xs-12">
                            <p><?=$received->sender->fullname?></p>
                            <p><?=$received->amount?></p>
                            <p><?=$received->datetime?></p>
                            <p><?=$received->message?></p>
                        </div>
                    <?php } ?>
                </div>
                <h3>Sent Transactions</h3>
                <div>
                    <?php foreach($user->sentTransactions as $sent){?>
                        <div class="col-xs-12">
                            <p><?=$sent->sender->fullname?></p>
                            <p><?=$sent->amount?></p>
                            <p><?=$sent->datetime?></p>
                            <p><?=$sent->message?></p>
                        </div>
                    <?php } ?>
                </div>
                <div>
                    <button id="new-transaction-btn" class="btn btn-info">New Transaction</button>
                </div>
                <div class="modal transaction-form" id="new-transaction-container">
                    <?php $tform=ActiveForm::begin(['action'=>Url::toRoute(['/cabinet/user-transaction/send-transaction']),'method'=>'post']);?>
                    <?= $tform->field($transactionModel, 'receiver_id')->dropDownList($transactionModel->prepareUsers()) ?>
                    <?= $tform->field($transactionModel, 'amount')->textInput() ?>
                    <?= $tform->field($transactionModel, 'message')->textarea() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                    <?php ActiveForm::end();?>
                </div>
            </div>
        </div>
    </section>

</aside>
<script>
    $("#new-message-btn").on('click',function()
    {
        $('#new-message-container').className+=' visible';
    });

$("#user-search").on('input',function()
{
    $.get("cabinet/user/ajax-search-user",
        {'keyword':$(this).val()},
        function (data)
        {
            var array=JSON.parse(data);
            var newHtml='';
            for(var i=0; i<array.length; i++)
            {
                newHtml+="<div><p>"+array[i].username+"</p><a href='/cabinet/friend-request/send-request?receiver_id="+array[i].id+"'>+</a></div>";
            }
            document.getElementById('search-suggestions-container').innerHTML=newHtml;
        });
});

$("#new-transaction-btn").on('click',function()
{
   $("#new-transaction-container").addClass(' visible');
});
    $("#new-message-btn").on('click',function()
    {
        $("#new-message-container").addClass(' visible');
    });
</script>