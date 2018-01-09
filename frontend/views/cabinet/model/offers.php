<?php
?>
<section id="report">
    <div class="container">
        <h3><?=Yii::t('app','Partnership confirmation')?></h3>
        <div class="row">
            <?php
            if(isset($data[0]) && is_array($data[0]) && !empty($data[0])){
                foreach($data[0] as $record){?>
            <div class="col-sm-6">
                <div class="item accept">
                    <div class="info">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="image-block">
                                    <img src="assets/img/reg-2.png" alt="">
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <p>
                                    <a href="/cabinet/client/view?id=<?=$record['client']->id?>"><?=$record['client']->contact_face?> <i class="icon">check_circle</i><small><?=$record['client']->organization?></small></a>
                                </p>
                                <p class="text">
                                    <?=$record['project']->description?>
<!--                                    <br>Место: Москва, ул. Льва 16, оф. Chanel inc.-->
<!--                                    <br>--><?php ////echo $record['project']->date_start?><!-- - --><?php //echo $record['project']->date_finish?>
<!--                                    <br>Оплата: 20$ в час-->
                                </p>
                                <p class="text">
                                    <?=$record['offer']->message?>
                                    <b><?=Yii::t('app','Pay rate')?>:</b> <?=\core\services\PaymentService::localizeCurrency($record['project']->category->price).\core\services\PaymentService::getLocalCurrency(true)?> в час.
                                </p>
                                <div class="rating">
                                    <!-- <a href="#"><i class="icon">remove_red_eye</i> Детали</a> -->
                                </div>
                                <a href="/offer/update?id=<?=$record['offer']->id.'&status=1'?>" class="btn"><?=Yii::t('app','Accept')?></a> <a href="/offer/update?id=<?=$record['offer']->id.'&status=2'?>" class="btn simple"><?=Yii::t('app','Reject')?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            }else{
            ?>
                <h3><?=Yii::t('app','You have no work offers yet')?></h3>
            <?php } ?>
        </div>
        <h3><?=Yii::t('app','Work history')?></h3>
        <p><?=Yii::t('app','Current projects')?></p>
        <div class="row">

            <?php if(isset($data[1]) && is_array($data[1]) && !empty($data[1])){
                foreach($data[1] as $record){?>

                    <div class="col-sm-6">
                        <div class="item accept">
                            <div class="info">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="image-block">
                                            <img src="assets/img/reg-2.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <p>
                                            <a href="/cabinet/client/view?id=<?=$record['client']->id?>"><?=$record['client']->contact_face?> <i class="icon">check_circle</i><small><?=$record['client']->organization?></small></a>
                                        </p>
                                        <p class="text">
                                            <?=$record['project']->description?>
                                            <!--                                    <br>Место: Москва, ул. Льва 16, оф. Chanel inc.-->
                                            <!--                                    <br>--><?php ////echo $record['project']->date_start?><!-- - --><?php //echo $record['project']->date_finish?>
                                            <!--                                    <br>Оплата: 20$ в час-->
                                        </p>
                                        <p class="text">
                                            <?=$record['offer']->message?>
                                        </p>
<!--                                        <div class="rating">-->
<!--                                            <!-- <a href="#"><i class="icon">remove_red_eye</i> Детали</a> -->
<!--                                        </div>-->
                                        <?php
                                        if(isset($record['chat']) && $record['chat']){?>
                                        <a class="modal" href="<?="/cabinet/chat?id={$record['chat']->id}"?>"><i class="icon">remove_red_eye</i><?=Yii::t('app','Go to chat')?></a>
                                         <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }

            }else{ ?>
            <h3><?=Yii::t('app','Currently you do not participate in any projects')?></h3>
            <?php } ?>
        </div>
        <p><?=Yii::t('app','Past projects')?></p>
        <div class="row">

            <?php if(isset($data['closed']) && is_array($data) && !empty($data)){
                foreach($data['closed'] as $record)
                {
                    ?>

                    <div class="col-sm-4 col-md-3">
                        <div class="item accept small">
                            <div class="info">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image-block">
                                            <img src="assets/img/reg-2.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                        <p>
                                            <?php echo $record['client']->contact_face?> <i class="icon">check_circle</i><small> <?php echo $record['client']->organization?></small>
                                            <small> <?php echo $data['project']->name?></small>
                                        </p>
                                        <div class="rating">
                                            <a href="#"><i class="icon">remove_red_eye</i> <?=Yii::t('app','Details')?></a>
                                            <?php   if(isset($record['chat']) && $record['chat']){?>
                                                <a class="modal" href="<?="/cabinet/chat?id={$record['chat']}"?>"><i class="icon">remove_red_eye</i><?=Yii::t('app','Go to chat')?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }else{?>
                <h3><?=Yii::t('app','You have to closed projects yet')?></h3>
            <?php } ?>
        </div>
    </div>
</section>