<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use core\services\manage\ReviewService;
use common\widgets\WOnline;


/* @var $this yii\web\View */
/* @var $searchModel core\entities\User\SearchReview */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $subject->user->getFullName();
$this->params['breadcrumbs'][] = $this->title;
?>

<section id="profile">
    <div class="head-info">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 col-sm-7">
                <div class="image-block user-avatar">
                    <img src="<?=Html::encode($subject->user->getAvatar());?>" alt="">
                </div>
                <div class="avatar-info">
                    <div class="name">
                        <?=Html::encode($subject->user->getFullName());?> <i class="icon">check_circle</i>
                        <span><?=WOnline::widget(['user_id' => $subject->user->id]); ?></span>
                    </div>
                    <div class="country">
                        <img src="assets/img/flag.jpg" alt=""> <?php if(isset($subject->characteristics['country'])){echo Html::encode($subject->characteristics['country']);}?> / <?php if(isset($subject->characteristics['age'])){echo Html::encode($subject->characteristics['age']);}?> / <?php if(isset($subject->characteristics['height'])){echo Html::encode($subject->characteristics['height']);}?> см
                    </div>
                    <div class="insta">
                        <a href="#"><img src="assets/img/icons/facebook.svg" alt=""></a> <a href="#"><img src="assets/img/icons/instagram.svg" alt=""></a>
                        <?php
                        if($subject->user->instagram)
                        {
                        $inst_id=explode($subject->user->instagram,'.')[0];
                            try
                            {
                                $result = file_get_contents("https://api.instagram.com/v1/users/".$inst_id."/?access_token=".$subject->user->instagram);
                                if($result)
                                {
                                    $obj = json_decode($result);
                                    echo "Instagram:".Html::encode($obj->data->counts->followed_by)." followers";
                                }
                            }catch(Exception $e)
                            {
                                Yii::$app->errorHandler->logException($e);
                            }

                        }
                        ?>
                    </div>
<?php switch($can_be_favoured){
    case 1:?>
    <div>
        <a href="/cabinet/client/favourites?f_id=<?=$subject->id?>&f_action=create"><?=Yii::t('app','Add to favourites')?></a>
    </div>
        <?php
    break;
    case 2:
    ?>
    <div>
        <a href="/cabinet/client/favourites?f_id=<?=$subject->id?>&f_action=delete"><?=Yii::t('app','Remove from favourites')?></a>
    </div>
    <?php
        break;
    default:
        break;
} ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-5">
                <div class="head-block">
                    <p>
                        <span><?=Html::encode($categories)?></span>
                    </p>
                    <p>
                        <span><?=Yii::t('app','Rating')?> <b>| <?=Html::encode(($subject->user->rating));?></b></span> <small><?=Html::encode(count($subject->user->reviews))?> <?=Yii::t('app','Reviews')?></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="block top">
                    <div class="title align-right"><?=Yii::t('app','Portfolio')?></div>
                    <div class="owl-carousel">
                        <div><img src="assets/img/model.jpg" alt=""></div>
                        <div><img src="assets/img/model.jpg" alt=""></div>
                        <div><img src="assets/img/model.jpg" alt=""></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <?= $this->render('_list', ['user' => $subject->user]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <?=$this->render('../default/reviews',['reviews'=>ReviewService::prepareReviews($subject->user->reviews)])?>

        </div>
    </div>
</section>
<?php if($can_leave_review){?>
<?=$this->render('../default/createReview',['model'=>$model,'assignments'=>$assignments])?>
<?php } ?>