<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 29.06.17
 * Time: 16:13
 */
use yii\helpers\Html;
?>

<div class="col-sm-6">
    <div class="block top">
        <div class="title"><?= Yii::t('app','Информация'); ?></div>
        <ul class="user-info">
            <?php foreach ($user->model->values as $value): ?>
                <?php if (!empty($value->value)): ?>
                    <li>
                        <span><?= Html::encode($value->characteristic->name) ?></span>
                        <?= Html::encode($value->value) ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>


        </ul>
        <p>
            <b><?= Yii::t('app','О себе:'); ?></b> <?= $user->model->description; ?>
        </p>
    </div>
</div>
