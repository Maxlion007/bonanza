<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\User\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div>
        <?=
//        echo $model->avatar;
         Html::a(Html::img($model->avatar->getThumbFileUrl('file', 'thumb')),
             $model->avatar->getUploadedFileUrl('file'),         ['class' => 'thumbnail', 'target' => '_blank'])
        ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'gender',
            'birthday',
            ['attribute'=>'Country',
                'value'=>function($model)
                {
                    return $model->country->name;
                }],
//            'country',
            'about:ntext',
//            'avatar',
            'wallet',
            'auth_key',
            'created_at',
            'updated_at',
            'played_games',
            'phone',
            ['attribute'=>'Status',
                'value'=>function($model)
                {
                    return \core\helpers\UserHelper::statusList()[$model->status];
                }]
        ],
    ]) ?>

</div>
