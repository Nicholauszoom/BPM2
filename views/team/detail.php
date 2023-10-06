<?php

use app\models\Project;
use app\models\Team;
use app\models\TeamAssignment;
use app\models\Tender;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\i18n\Formatter;

/** @var yii\web\View $this */
/** @var app\models\TenderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$project = Project::findOne($projectId);
$project_tender = $project ? $project->tender_id : '';
$project_tender_id=Tender::findOne($project_tender);
$projectName = $project_tender_id ? $project_tender_id->title : '';
$this->title = 'Team :' . $projectName . ' Project';


$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = 'admin';
?>
<div id="main-content ">
   
   <div id="page-container">
       <!-- ============================================================== -->
       <!-- Sales Cards  -->
       <!-- ============================================================== -->
       <div class="row"></div>
<div class="tender-index">
<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  

    <?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $team,
        'pagination' => [
            'pageSize' => 10, // Adjust the page size as per your requirement
        ],
        'sort' => [
            'attributes' => [
                // 'created_at' => [
                //     'asc' => ['created_at' => SORT_ASC],
                //     'desc' => ['created_at' => SORT_DESC],
                //     'default' => SORT_DESC,
                //     'label' => 'Created At',
                // ],
            ],
            'defaultOrder' => [
               
            ],
        ],
    ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'team_no',
                'value' => function ($model) {
                    return getTeamLabel($model->team_no);
                },
            ],
            // 'status',
            [
                'attribute' => 'member',
                'format' => 'raw',
                'value' => function ($model) {
                    $assignments = TeamAssignment::find()
                        ->where(['team_id' => $model->id])
                        ->all();
                
                    $assignedUsernames = [];
                
                    foreach ($assignments as $assignment) {
                        $user = User::findOne($assignment->user_id);
                        if ($user) {
                            $assignedUsernames[] = $user->username;
                        }
                    }
                
                    return implode(', ', $assignedUsernames);
                },
            ],
  
           
           
            
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return getStatusLabel($model->status);
                },
                'format' => 'raw',
                'contentOptions' => function ($model) {
                    return ['class' => getStatusClass($model->status)];
                },
            ],
           
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Team $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            // ///////////////////
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{view} {create-project}  {update}',
            //     'buttons' => [
                    
            //         'view' => function ($url, $model, $key) {
            //             return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id], [
            //                 // 'class' => 'btn btn-success',
            //                 'title' => 'view tender',
            //                 'aria-label' => 'tender view',
            //             ]);
            //         },
    
    
            //         'update' => function ($url, $model, $key) {
            //             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], [
            //                 // 'class' => 'btn btn-success',
            //                 'title' => 'view tender',
            //                 'aria-label' => 'tender update',
            //             ]);
            //         },
            //     ],
                
            // ],
            // ///////////////
        ],
    ]); ?>
    <?php
function getStatusLabel($status)
{
    $statusLabels = [
        1 => '<span class="badge badge-success">Active</span>',
        2 => '<span class="badge badge-warning">Inactive</span>',
        3 => '<span class="badge badge-secondary">.</span>',


        
    ];

    return isset($statusLabels[$status]) ? $statusLabels[$status] : '';
}

function getStatusClass($status)
{
    $statusClasses = [
       
        1 => 'status-active',
        2 => 'status-inactive',
        3 => 'status-onhold',
    ];

    return isset($statusClasses[$status]) ? $statusClasses[$status] : '';
}

function getTeamLabel($status)
{
    $statusLabels = [
        1 => 'NO',
        2 => 'YES',
    ];

    return isset($statusLabels[$status]) ? $statusLabels[$status] : '';

}
?>



</div>
   </div>
</div>
