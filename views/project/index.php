<?php

use app\models\Project;
use app\models\Request;
use app\models\Tender;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\i18n\Formatter;

/** @var yii\web\View $this */
/** @var app\models\ProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
// $this->context->layout = 'admin';
$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = 'admin';
$currentUrl = Url::toRoute(Yii::$app->controller->getRoute());
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js');

// Define an array of sidebar items with their URLs and labels
$sidebarItems = [
    ['url' => ['/dashboard/admin'], 'label' => 'Home', 'icon' => 'bi bi-house'],
    ['url' => ['/project'], 'label' => 'Projects', 'icon' => 'bi bi-layers'],
    ['url' => ['/task'], 'label' => 'Task', 'icon' => 'bi bi-check2-square'],
    ['url' => ['/team'], 'label' => 'Team', 'icon' => 'bi bi-people'],
    ['url' => ['/member'], 'label' => 'Member', 'icon' => 'bi bi-person'],
    ['url' => ['/report'], 'label' => 'Report', 'icon' => 'bi bi-file-text'],
    ['url' => ['/setting'], 'label' => 'Settings', 'icon' => 'bi bi-gear'],
];
?>
<!--
<div id="loading-bar-container" class="loading-bar-container">
  <div id="loading-bar" class="loading-bar"></div>
</div>-->

<div id="main-content "><a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>
   
    <div id="page-container">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row"></div>
       
           <!--<p>
                <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
            </p>-->
          
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            $dataProvider = new ActiveDataProvider([
                'query' => Project::find()->orderBy(['created_at' => SORT_DESC]),
                'sort' => false, // Disable sorting in the GridView
            ]);
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    [
                        'attribute'=>'tender_id',
                        'format'=>'raw',
                        'value'=>function ($model){
                            $tender = Tender::findOne($model->tender_id);
                            $tenderTitle = $tender ? $tender->title : 'Unknown';
                             return $tenderTitle;
                        },
                    ],
                    // 'description:ntext',
                    'budget',
                    
                    [
                        'attribute' => 'progress',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $progress = $model->progress;
                            $progressBar = '<div class="progress progress_sm">';
                            $progressBar .= '<div class="progress-bar bg-green" role="progressbar" style="width: ' . $progress . '%;"></div>';
                            $progressBar .= '</div>';
                            $progressBar .= '<small>' . $progress . '% Complete</small>';
                            return $progressBar;
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
                        'attribute' => 'end_at',
                        'format' => 'raw',
                        'label' => 'Submitted Date',
                        'value' => function ($model) {
                            $now = time();
                            $expiredDate = $model->end_at;
                            $oneWeekAhead = strtotime('+1 week');
                            $labelClass = '';
            
                            if ($expiredDate - $now <= 0) {
                                $labelClass = 'badge badge-danger'; // Red label
                            } elseif ($expiredDate > $oneWeekAhead) {
                                $labelClass = 'badge badge-success'; // Yellow label
                            } elseif($expiredDate - $now > 0) {
                                $labelClass = 'badge badge-warning'; // Green label
                            }else{
                                $labelClass = 'badge badge-secondary';
                            }
            
                            $formatter = new Formatter();
                            $formattedDate = $formatter->asDate($model->end_at, 'php:Y-m-d H:i:s');
                            $label = Html::tag('span', Html::encode($formattedDate), ['class' => $labelClass]);
                            return $label;
                        },
                    ],
                //     [
                //         'attribute' => 'created_at',

                //         'value' => function ($model) {
                //             return Yii::$app->formatter->asDatetime($model->created_at);
                //         },
                       
                // ],
                [
                    'attribute'=>'user_id',
                    'format'=>'raw',
                    'value'=>function ($model){
                        $createdByUser = User::findOne($model->user_id);
                        $createdByName = $createdByUser ? $createdByUser->username : 'Unknown';
                         return $createdByName;
                    },
                ],
                [
                    'attribute' => 'isViewed',
                    'label' => 'alert',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->isViewed ? '' : Html::tag('span', 'New', ['class' => 'badge badge-success']);
                    },
                ],
                
              
                    //'updated_at',
                    //'created_by',
                    //'ducument',
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'urlCreator' => function ($action, Project $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //     }
                    // ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'contentOptions' => ['style' => 'text-align:center'],
                        'template' => '<div style="display:flex; justify-content:center;">{view} {create-analysis} {create-task} {update} {team}</div>',
                        'buttons' => [
                            'create-analysis' => function ($url, $model, $key) {
                                $request_project_new = Request::find()
                                    ->where(['viewed' => 0])
                                    ->andWhere(['project_id' => $model->id])
                                    ->andFilterWhere(['status' => 1])
                                    ->count();
                    
                                $badge = ($request_project_new > 0)
                                    ? '<span class="badge bg-blue">' . $request_project_new . '</span>'
                                    : '';
                    
                                return Html::a($badge . '<span class="glyphicon glyphicon-file"></span>', ['request/all', 'projectId' => $model->id], [
                                    // 'class' => 'btn btn-success',
                                    'title' => 'View Requests',
                                    'aria-label' => 'Requests',
                                ]);
                            },
                   
                           
            
                            'view' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    ['view', 'id' => $model->id],
                                    [
                                        'title' => 'View project',
                                        'aria-label' => 'Project view',
                                        'id' => 'view',
                                        'onclick' => 'showBar();',
                                    ]
                                );
                            },
            
                            'update' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['edit', 'id' => $model->id], [
                                    // 'class' => 'btn btn-success',
                                    'title' => 'edit project',
                                    'aria-label' => 'Project edit',
                                ]);
                            },

                            'team' => function ($url, $model, $key) {
                                return Html::a('<span class="fa fa-group"></span>', ['team/detail', 'projectId' => $model->id], [
                                    // 'class' => 'btn btn-success',
                                    'title' => ' project team',
                                    'aria-label' => 'Project team',
                                ]);
                            },
                        ],
                        
                    ],
                   
                ],
                
                
            ]); ?>

<?php
function getStatusLabel($status)
{
    $statusLabels = [
        1 => '<span class="badge badge-success">Completed</span>',
        2 => '<span class="badge badge-warning">Onprogress</span>',
        3 => '<span class="badge badge-secondary">On Hold</span>',

       
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
?>
        </div>
    </div>
</div>

<script>

// Show the loading bar
function showBar() {
    document.getElementById('loading-bar-container').style.display = 'flex';
  }

  // Hide the loading bar
  function hideLoadingBar() {
    document.getElementById('loading-bar-container').style.display = 'none';
  }

  // Add click event listener to the "view" button
  document.addEventListener('DOMContentLoaded', function() {
    var viewBtn = document.getElementById('view');
    if (viewBtn) {
      viewBtn.addEventListener('click', function() {
        showLoadingBar();
      });
    }
  });

  // Hide the loading bar when the URL changes
  window.addEventListener('beforeunload', function() {
    hideLoadingBar();
  });
</script>
  