<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\User\Project */

$this->title = 'Update Project: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section id="report">
    <div class="container">

        <div class="row">
            
            <div class="col-xs-12">
				<div class="project-update">

				    <h2><i class="icon">event</i> <?= Html::encode($this->title) ?></h2>

				    <?= $this->render('_form', [
				        'model' => $model, 'categories'=>$categories
				    ]) ?>
				</div>

            </div>

        </div>

    </div>

</div>
