<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\entities\User\Project */

$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section id="report">
    <div class="container">

        <div class="row">
            
            <div class="col-xs-12">

				<div class="project-create">

				    <h2><i class="icon">event</i> <?= Html::encode($this->title) ?></h2>

				    <?= $this->render('_form', [
				        'model' => $model, 'categories'=>$categories
				    ]) ?>
				</div>

            </div>

        </div>

    </div>

</div>
