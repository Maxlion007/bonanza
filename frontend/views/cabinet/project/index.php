<?php
use Yii;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\User\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Projects and jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

<section id="report">
    <div class="container">

        <div class="row">
            
            <div class="col-xs-12">

                <div class="project-index">

                    <h2><i class="icon">info_outline</i><?= Html::encode($this->title) ?></h2>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <p>
                        <?= Html::a('Create project', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'layout' => "{pager}\n{items}\n{pager}\n{summary}\n",
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
                             return $model->closed == 1 ? Yii::t('app','Yes') : Yii::t('app','No');}
                             ],
                //            'models_count',
                //            [
                //                'value'=>function ($model)
                //                {
                //                    return 10;
                //                }
                //            ],
                            ['class' => 'yii\grid\ActionColumn'],


                        ],
                    ]); ?>
                </div>

            </div>

        </div>

    </div>

</div>
