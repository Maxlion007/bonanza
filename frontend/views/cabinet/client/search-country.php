<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04.09.2017
 * Time: 17:29
 */?>
<body class="country">
<!-- <header id="head">
    <div class="container">
        <div class="panel">
            <div class="logotype">
                <a href="/"><img src="assets/img/logo.png" alt=""></a>
            </div>
        </div>
    </div>
</header> -->
<div class="choose">
    <h1><?=Yii::t('app','Choose country');?></h1>
    <div class="russia">
        <a href="/cabinet/client/search-model?country=<?=Yii::t('app','Russia');?>"><?=Yii::t('app','Russia');?></a>
    </div>
    <div class="italia">
        <a href="/cabinet/client/search-model?country=<?=Yii::t('app','Spain');?>"><?=Yii::t('app','Spain');?></a>
    </div>
</div>
</body>
