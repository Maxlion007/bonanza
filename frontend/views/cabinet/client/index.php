<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 24.05.17
 * Time: 12:04
 */

use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;
use yii\widgets\DetailView;
use core\entities\User\User;
use common\widgets\EditBlockUser;
use common\widgets\WOnline;
use core\services\manage\ReviewService;


$this->title = $user->client->organization;
$this->params['breadcrumbs'][] = $this->title;
?>

<section id="profile">
    <div class="head-info">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 col-sm-7">
                <div class="image-block user-avatar">
                    <?= Html::img(Html::encode($user->getAvatar())); ?>
                </div>
                <div class="avatar-info">
                    <div class="name">
                        <?= $user->getfullName(); ?> <i class="icon">check_circle</i>
                        <span><?= WOnline::widget(['user_id' => $user->getId()]); ?></span>
                    </div>

                </div>
            </div>
            <?= EditBlockUser::widget(); ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="block panel">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/cabinet/client/favourites"><i class="icon">star</i> <?=Yii::t('app','Favourites')?></a>
                        </div>
                        <!--div class="col-md-4">
                            <a href="/cabinet/project/browse?ProjectSearch[closed]=1"><i class="icon">history</i><?=Yii::t('app','Work history')?></a>
                        </div-->
                        <!--div class="col-md-4">
                            <a href="/cabinet/project"><i class="icon">cached</i><?=Yii::t('app','Current projects')?></a>
                        </div-->
                        <div class="col-md-4">
                            <a href="/cabinet/chat"><i class="icon">cached</i><?=Yii::t('app','Chats')?></a>
                        </div>
                        <div class="col-md-4">
                            <a href="/cabinet/client/offers"><i class="icon">cached</i><?=Yii::t('app','Offers')?></a>
                        </div>
                    </div>
                </div>
                <?= $this->render('_list', ['user' => $user]); ?>
                <?=$this->render('../default/reviews',['reviews'=>ReviewService::prepareReviews($user->reviews)])?>
            </div>
        </div>
    </div>
</section>

