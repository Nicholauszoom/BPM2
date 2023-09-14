<?php

use app\models\Analysis;
use app\models\Project;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AnalysisSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Analyses';
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = 'admin';

// $model = Project::findOne($project);

?>
<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>
<div class="analysis-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            
            'item',
            'description',
            'quantity',
            'cost',
            // [
            //     'label' => 'Project Name',
            //     'value' => $model->project->title,
            // ],
            'project',
            //'cost',
            //'boq',
            //'files',
            //'created_at',
            //'updated_at',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Analysis $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
