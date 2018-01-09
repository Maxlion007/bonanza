<?php
?>
<section id="report">
    <div class="container">
        <h2><i class="icon">work</i> <?=Yii::t('app','Work offers');?></h2>
        <div class="row">

            <?php if(count($data)>0)
            {
                foreach($data as $record){?>
                    <div class="col-md-8 col-sm-6">
                        <div class="item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="image-block">
                                                    <a href="/profile-model-others.html">
                                                        <img src="assets/img/user.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xs-5">
                                                <p>
                                                    <?php if($record['offer']->status==1){?><a href="/cabinet/model/view?id=<?=$record['model']->id?>">
                                                        <?=$record['model']->first_name.' '.$record['model']->last_name?><small><?=$record['category']?></small>
                                                    </a><?php }else{ ?>
                                                <?=$record['model']->first_name.' '.$record['model']->last_name?><small><?=$record['category']?></small>
                        <?php } ?>
                                                </p>
                                            </div>
                                            <div class="col-xs-3">
                                                <span><b><?=Yii::t('app','Rating')?></b><br><?=$record['model']->user->getRating();?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price">
                                        <?php //echo Yii::t('app','To be paid')?> <!--<span>250$</span>-->
                                        <?php switch($record['offer']->status)
                                            {
                                            case 0:
                                                echo "<div class=\"result orange\">".Yii::t('app','Waiting for response')."</div>";
                                                break;
                                            case 1:
                                                echo "<div class=\"result green\">".Yii::t('app','Offer accepted')."</div>";
                                                break;
                                            case 2:
                                                echo "<div class=\"result red\">".Yii::t('app','Offer rejected')."</div>";
                                                break;
                                        }?>
                                    </div>
                                    <br>
                                    <a href="/cabinet/client/search-model" class="btn outline full-width"><?=Yii::t('app','Continue search')?></a>
                                    <?php if ($record['offer']->status==1){
                                        ?>
                                        <br>
                                        <br>
                                        <?php if($record['offer']->order && $record['offer']->order->status==1){ ?>
                                            <p><?=Yii::t('app','This project has already been pre-paid')?></p>

                                        <?php }else{?>
                                            <a href="/cabinet/client/payment?offer_id=<?=$record['offer']->id?>" class="modal btn full-width"><?=Yii::t('app','Reserve funds')?></a>
                                        <?php } ?>
                                    <?php } ?>
<!--                                    <div class="check">-->
<!--                                        <input type="checkbox" id="social-sec">-->
<!--                                        <label for="social-sec" data-container="body" data-toggle="popover" data-placement="top" data-content="Lorem ipsum dolor sit amet.">--><?//=Yii::t('app','Arrange social insurance')?><!-- - 2€</label>-->
<!--                                    </div>-->
<!--                                    <a href="#cloth" class="modal">-->
<!--                                        <div class="check">-->
<!--                                            <input type="checkbox" id="clothe">-->
<!--                                            <label for="clothe">--><?php ////echo Yii::t('app','Lease clothes')?><!-- - 50€</label>-->
<!--                                        </div>-->
<!--                                    </a>-->
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b><?=Yii::t('app','Project description')?>:</b> <?=$record['project']->description;?>
                                    </p>
                                    <p>
                                        <b> <?=Yii::t('app','Start date')?>:</b> <?=$record['project']->date_start?>;
                                    </p>
                                    <p>
                                        <b><?=Yii::t('app','End date')?>:</b> <?=$record['project']->date_finish?>
                                    </p>
                                    <p>
                                        <b><?=Yii::t('app','Pay rate')?>:</b> <?=\core\services\PaymentService::localizeCurrency($record['project']->category->price).\core\services\PaymentService::getLocalCurrency(true)?> в час.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>

        </div>
    </div>
</section>
