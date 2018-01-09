<?php

use yii\helpers\Html;
?>
    <section id="report">
        <div class="container">
            <h2><i class="icon">star</i> Избранное</h2>
            <div class="row">

                <?php foreach($favourites as $favourite){?>
                <div class="col-md-4 col-sm-6">
                    <div class="item fav">
                        <a href="/cabinet/model/view?id=<?=Html::encode($favourite->id)?>">
                            <div class="info">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="image-block">
                                            <img src="<?=Html::encode($favourite->user->getAvatar())?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <p>
                                            <?=Html::encode($favourite->user->getFullName())?><small><?=Html::encode($favourite->characteristics[5])?> лет</small><small><?php $cat_names=[];foreach($favourite->categories as $cat){$cat_names[]=$cat->name;} Html::encode(implode(', ',$cat_names))?></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="rating">
                                Балл - <span><?=Html::encode($favourite->user->rating)?></span>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>