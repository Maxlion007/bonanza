<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\User\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Projects and jobs');
$this->params['breadcrumbs'][] = $this->title;
?>

<section id="report">
    <div class="container">

        <div class="row">
            
            <div class="col-xs-12">

                <div class="project-index">

                     <h2><i class="icon">info_outline</i> <?= Html::encode($this->title) ?></h2>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <style>
                        td a
                        {
                            border:1px solid black;
                            width: 30px;
                            height:30px;
                            display:block;
                        }
                    </style>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                //            'id',
                //            'client_id',
                            'name',
                            'description',
                             'date_start',
                             'date_finish',
                            'profit',
                             ['attribute'=>'closed',
                             'value'=> function ($model) {
                             return $model->closed == 1 ? 'Да' : 'Нет';}
                             ],
                //            'models_count',
                //            [
                //                'value'=>function ($model)
                //                {
                //                    return 10;
                //                }
                //            ],
                        ]
                    ]); ?>
                </div>
            </div>

        </div>
</div>
</div>
