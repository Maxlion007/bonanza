<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\transactions\GameTransaction */

$this->title = 'Create Game Transaction';
$this->params['breadcrumbs'][] = ['label' => 'Game Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
