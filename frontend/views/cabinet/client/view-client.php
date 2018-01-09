<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use core\services\manage\ReviewService;
use common\widgets\WOnline;


/* @var $this yii\web\View */
/* @var $searchModel core\entities\User\SearchReview */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>

<section id="profile">
    <div class="head-info">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 col-sm-7">
                <div class="image-block user-avatar">
                    <img src=<?=Html::encode($subject->user->getAvatar());?>" alt="">
                </div>
                <div class="avatar-info">
                    <div class="name">
                        <?=$subject->contact_face;?> <i class="icon">check_circle</i>
                        <span><?= WOnline::widget(['user_id' => $subject->user->id]); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5">
                <div class="head-block">
<!--                    <p>-->
<!--                        <span>Fashion</span>-->
<!--                    </p>-->
                    <p>
                        <span><?=Yii::t('app','Rating')?> <b>| <?=$subject->user->rating;?></b></span> <small><?=count($subject->user->reviews)?> <?=Yii::t('app','Reviews')?></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <?= $this->render('_list', ['user' => $subject->user]); ?>
                <?=$this->render('../default/reviews',['reviews'=>ReviewService::prepareReviews($subject->user->reviews)])?>

            </div>
        </div>
    </div>
</section>
<?php

if($can_leave_review)
{
echo $this->render('../default/createReview',['model'=>$model,'assignments'=>$assignments]);
}
?>
