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
use yii\helpers\Url;
use \core\helpers\ModelDataHelper;
$this->title = $user->getFullName();
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="assets/js/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="assets/js/ie/html5shiv.min.js"></script>
    <script src="assets/js/ie/respond.min.js"></script>
    <![endif]-->
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/libs/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/libs/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.modal').magnificPopup({
            type: 'inline',
            preloader: false
        });
        $(".owl-carousel").owlCarousel({
            loop: true,
            items: 1,
            dots: false,
            nav: true,
            navText: [
                "<img src='/assets/img/icons/chevron-left.png'>",
                "<img src='/assets/img/icons/chevron-right.png'>"
            ]
        });
    });
    </script>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

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
                    <div class="name">
                        <?= ModelDataHelper::formatCountryAgeHeight($user->model);?>
                    </div>
                </div>
            </div>
            <?= EditBlockUser::widget(); ?>

        </div>
    </div>
    <div class="container">
    <div class="row col-sm-6 col-sm-offset-3">
                    <?php try {
                        if ($user->instagram && isset($instagram->getUser()->data)) {
                            ?><a href='http://instagram.com/<?= $instagram->getUser()->data->username; ?>'><?=Yii::t('app','Your profile in Instagram')?></a><i><?=Yii::t('app','You may asked to re-assign this account.')?></i><?php
                        } else {
                            echo "<a href='{$instagram->getLoginUrl()}'>".Yii::t('app','Assign Instagram account to your profile').".</a>";
                        }
                    }catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }?>
    </div>
        <div class="row col-sm-12">
            <div class="col-sm-6">
                <?php if($photos!=null){?>
                    <div class="block top">
                        <div class="title align-right">Фотографии</div>
                        <div class="owl-carousel">
                        <?php for($i=0;$i<count($photos);$i++){ ?>
                            <div><?=Html::img($photos[$i]->file);?></div>
                        <?php } ?>
                        </div>
                <a href="/cabinet/model/portfolio" class="add">+ <?=Yii::t('app','Добавить работу')?></a>
                    </div>
                    <?php } ?>


            </div>
            <?= $this->render('_list', ['user' => $user]); ?>
            <div class="col-xs-12">
                <div class="block panel col-xs-6" style="margin-left: 25%">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/cabinet/model/calendar"><i class="icon">date_range</i><?=Yii::t('app','Calendar')?></a>
                        </div>
                        <div class="col-md-4">
                            <a href="/cabinet/project/browse?ProjectSearch[closed]=1"><i class="icon">history</i><?=Yii::t('app','Work history')?></a>
                        </div>
                        <div class="col-md-4">
                            <a href="/cabinet/project/browse"><i class="icon">cached</i><?=Yii::t('app','Current projects')?></a>
                        </div>
                        <div class="col-md-4">
                            <a href="/cabinet/chat"><i class="icon">cached</i><?=Yii::t('app','Chats')?></a>
                        </div>
                        <div class="col-md-4">
                            <a href="/cabinet/model/offers"><i class="icon">cached</i><?=Yii::t('app','Work offers')?></a>
                        </div>

                    </div>
                </div>                
            </div>
            <div class="col-xs-12">
                                        <?=$this->render('../default/reviews',['reviews'=>ReviewService::prepareReviews($user->reviews)])?>
            </div>


        </div>

    </div>
</section>

