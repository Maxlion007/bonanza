<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\User\ChatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chats';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="chat" class="mfp-hide white-popup-block">
    <div class="chat-content">
        <div class="panel">
            <div class="title toggle-open"><i class="icon visible-xs-inline-block">expand_more</i> Проекты в работе</div>
            <div class="toggle">
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="image-block">
                                    <img src="assets/img/user.png" alt="">
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <b>Hanna L.</b> <i class="icon new">fiber_new</i>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="image-block">
                                    <img src="assets/img/user.png" alt="">
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <b>Hanna L. 2</b>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="image-block">
                                    <img src="assets/img/user.png" alt="">
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <b>Hanna L. 3</b>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="status">
                    <div class="checkbox">
                        <input type="radio" name="project-status" id="status-project-1">
                        <label for="status-project-1">Выполнен</label>
                    </div>
                    <div class="checkbox red">
                        <input type="radio" name="project-status" id="status-project-2">
                        <label for="status-project-2">Не выполнен</label>
                    </div>
                    <p>
                        Одобряйте работу только после ее исполнения.
                    </p>
                    <div class="check">
                        <input type="checkbox" id="cancel-client">
                        <label for="cancel-client">Проект отменен по инициативе клиента</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="messages">
            <div class="title"><b>Проект:</b> Фотосет на выставке в Доме Культуры</div>
            <div class="content">
                <div class="people">
                    <span>Участники чата</span>
                    <a href="#"><img src="assets/img/user.png" alt=""></a>
                    <a href="#"><img src="assets/img/user.png" alt=""></a>
                    <a href="#"><img src="assets/img/user.png" alt=""></a>
                </div>
                <ul>
                    <li>
                        <span class="date">Ноябрь 16</span>
                        <div class="row">
                            <div class="col-sm-3 col-xs-12">
                                <div class="time">
                                    Nov 15 <span>16:40</span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-9">
                                <div class="text">
                                    Условия работы: 17.02.2017 с 14:30 до 17:30. Фотосет на выставке. Оплата 25 у.е. в час. Вы согласны на такие условия?
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-3">
                                <a href="#" class="name">
                                    <div class="image-block">
                                        <img src="assets/img/reg-2.png" alt="">
                                    </div>
                                    <span>Channel inc.</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="reply">
                        <div class="row">
                            <div class="col-sm-3 col-xs-3">
                                <a href="#" class="name">
                                    <div class="image-block">
                                        <img src="assets/img/user.png" alt="">
                                    </div>
                                    <span>Hanna</span>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xs-9">
                                <div class="text">
                                    Добрый день, буду рада сотрудничеству!
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="time">
                                    Nov 15 <span>16:40</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <span class="date">Ноябрь 16</span>
                        <div class="row">
                            <div class="col-sm-3 col-xs-12">
                                <div class="time">
                                    Nov 15 <span>16:40</span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-9">
                                <div class="text">
                                    Условия работы: 17.02.2017 с 14:30 до 17:30. Фотосет на выставке. Оплата 25 у.е. в час. Вы согласны на такие условия?
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-3">
                                <a href="#" class="name">
                                    <div class="image-block">
                                        <img src="assets/img/reg-2.png" alt="">
                                    </div>
                                    <span>Channel inc.</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="reply">
                        <div class="row">
                            <div class="col-sm-3 col-xs-3">
                                <a href="#" class="name">
                                    <div class="image-block">
                                        <img src="assets/img/user.png" alt="">
                                    </div>
                                    <span>Hanna</span>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xs-9">
                                <div class="text">
                                    Добрый день, буду рада сотрудничеству!
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="time">
                                    Nov 15 <span>16:40</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <form class="write" action="">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="write-message">
                            <textarea name="" id="" rows="3" placeholder="Введите Ваше сообщение"></textarea>
                            <a class="link" href="/recall-client.html" type="submit"><i class="icon">send</i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="chat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php var_dump($chats)?>
</div>
