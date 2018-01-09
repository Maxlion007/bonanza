<?php
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<style>
    .portfolio
    {
        width:100%;
        padding:2%;
        border-top:1px solid black;
        text-align:center;
    }
    .portfolio h2
    {
        font-family: 'Roboto', sans-serif;
    }
    .portfolio div div
    {
        position:relative;
        width:330px;
        padding:15px;
        border:1px solid #ddd;
        border-radius:5px;
        float:left;
    }
    .protfolio div div a
    {
        float:left;
    }
    .portfolio div
    {
        min-height:360px
    }
</style>
<div class="portfolio container">
    <h2><?=Yii::t('app','Portfolio')?></h2>
    <div>
        <?php
            for($i=0;$i<count($photos);$i++)
            {

            ?>
            <div>
                <?=$photos[$i]->sort?>
            <a href="http://how.profitserver.in.ua/cabinet/photo/set-sort?photo_id=<?=$photos[$i]->id?>&direction=left"><-</a>
            <a href="http://how.profitserver.in.ua/cabinet/photo/delete?photo_id=<?=$photos[$i]->id?>">X</a>
            <a href="http://how.profitserver.in.ua/cabinet/photo/set-sort?photo_id=<?=$photos[$i]->id?>&direction=right">-></a>
            <?=Html::img($photos[$i]->file,['style' => ['width' => '300px', 'max-height'=>'400px','float'=>'left']]);?>
            </div>
        <?php if(($i+1)%4==0 && $i!==0 && ($i+1)!==count($photos))
        {
        ?></div><div><?php
        }?>

        <?php
            } ?>
        </div>
    </div>
</div>

<?php
echo FileInput::widget([
    'name'=>'file[]',
    'options'=>[
        'multiple'=>true
    ],
    'pluginOptions'=>[
        'uploadUrl'=>Url::to(['cabinet/photo/add-portfolio']),
        'uploadExtraData'=>[
            'filename'=>'Tailieu',],
		'maxFileCount'=>20
		]
		]);