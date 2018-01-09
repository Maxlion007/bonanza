<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\User\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class=" panel container">
    <?php
    if(!empty($projects)) {
        $attributeLabels=$projects[0]->attributeLabels();
        ?>
        <table class="table">
            <tr>
                <td>#</td>
                <td><?=$attributeLabels['name'];?></td>
                <td><?=$attributeLabels['description'];?></td>
                <td><?=$attributeLabels['date_start'];?></td>
                <td><?=$attributeLabels['date_finish'];?></td>
                <td><?=$attributeLabels['profit'];?></td>
                <td><?=$attributeLabels['closed'];?></td>
                <td>Действия</td>
            </tr>
        <?php
        foreach ($projects as $project) {
            ?>
            <tr>
                <td></td>
                <td><?=$project->name;?></td>
                <td><?=$project->description;?></td>
                <td><?=$project->date_start;?></td>
                <td><?=$project->date_finish;?></td>
                <td><?=$project->profit;?></td>
                <td><?php if($project->closed==1){echo "Да";}else{echo "Нет";};?></td>
                <td><a href="/cabinet/project/view?id=<?=$project->id?>">Открыть</a>
                    <br>
                    <a href="/cabinet/project/update?id=<?=$project->id?>">Редактировать</a>
                    <br>
                    <a href="/cabinet/project/delete?id=<?=$project->id?>">Удалить</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
            <?php
    }else
        {
            ?>
            <h2>У Вас нет проектов</h2>
            <?php
        }?>

</div>
