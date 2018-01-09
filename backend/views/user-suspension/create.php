<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\User\UserSuspension */

$this->title = 'Create User Suspension';
$this->params['breadcrumbs'][] = ['label' => 'User Suspensions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-suspension-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
