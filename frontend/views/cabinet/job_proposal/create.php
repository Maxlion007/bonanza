<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\User\JobProposal */

$this->title = 'Create Job Proposal';
$this->params['breadcrumbs'][] = ['label' => 'Job Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-proposal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
