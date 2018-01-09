<?php
?>

<div class="block comments">
    <div class="title">
        Комментарии
    </div>
    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1"><i class="icon">thumb_up</i> <?=Yii::t('app','Successful projects')?></li>
        <li class="tab-link" data-tab="tab-2"><i class="icon">thumb_down</i><?=Yii::t('app','Unsuccessful projects')?></li>
    </ul>
    <div id="tab-1" class="tab-content current">
        <?php if(isset($reviews['good'])) {
            foreach ($reviews['good'] as $review) {
                ?>
                <div class="item">
                    <div class="title"><?=$review->author->getName();?></div>
                    <div class="text">
                        <div class="avatar">
                            <a href="/cabinet/<?php if($review->author->isClient()){echo "client/";}elseif($review->author->isModel()){echo "model/";}echo $review->author->getSecondary()->id;?>">
                                <img src="<?=$review->author->getAvatar()?>" alt="">
                            </a>
                        </div>
                        <b><?=$review->project->name?></b>
                        <p>
                            <?=$review->message?>
                        </p>
                        <div class="rating">
                            <div class="date"><?=$review->date?></div> <?=Yii::t('app','Rating')?> - <span><?=$review->rating?></span>
                        </div>
                    </div>
                </div>

                <?php
            }
        }
        ?>

    </div>
    <div id="tab-2" class="tab-content">
        <?php

        if(isset($reviews['bad'])) {
            foreach ($reviews['bad'] as $review) {
                ?>
                <div class="item">
                    <div class="title"><?php if($review->author->getName()){echo $review->author->getName();}else{echo "Aноним";};?></div>
                    <div class="text">
                        <div class="avatar">
                            <a href="/profile-model-others.html">
                                <img src="<?=$review->author->getAvatar()?>" alt="<?php if($review->author->getName()){echo $review->author->getName();}else{echo "Aноним";} ?>">
                            </a>
                        </div>
                        <b><?php if($review->project){ echo $review->project->name;}else{echo "Название проекта недоступно";}?></b>
                        <p>
                            <?=$review->message?>
                        </p>
                        <div class="rating">
                            <div class="date"><?=$review->date?></div> <?=Yii::t('app','Rating')?> - <span><?=$review->rating?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
        } ?>
    </div>
</div>
