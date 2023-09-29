<?php

use app\models\Analysis;
use app\models\Project;
use app\models\Tender;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Project $model */

     

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->context->layout = 'admin';


$project = Project::findOne($id);
$project_tender = $project ? $project->tender_id : '';
$project_tender_id=Tender::findOne($project_tender);
$projectName = $project_tender_id ? $project_tender_id->title : '';
$this->title = 'View for :' . $projectName . ' Project';

?>

<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>

   
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        
        <div class="row">
<div class="project-view col-md-12">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
              'attribute'=>'tender_id',
              'format'=>'raw',
              'value'=>function ($model){
                  $tender = Tender::findOne($model->tender_id);
                  $tenderTitle = $tender ? $tender->title : 'Unknown';
                   return $tenderTitle;
              },
          ],
            'description:ntext',
            'budget',
            
            // [
            //     'attribute' => 'user_id',
            //     'value' => 'user.email',
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
                'attribute' => 'start_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->start_at);
                },
            ],
            [
                'attribute' => 'end_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->end_at);
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at);
                },
            ],
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
                'attribute'=>'created_by',
                'format'=>'raw',
                'value'=>function ($model){
                    $createdByUser = User::findOne($model->created_by);
                    $createdByName = $createdByUser ? $createdByUser->username : 'Unknown';
                     return $createdByName;
                },
            ],
            
//          [
//     'attribute' => 'status',
//     'value' => function ($model) {
//         return getStatusLabel($model->status);
//     },
//     'format' => 'raw',
//     'contentOptions' => ['class' => function ($model) {
//         return getStatusClass($model->status);
//     }],
//     'headerOptions' => ['class' => 'status-column-header'],
//     'class' => 'yii\grid\DataColumn',
// ],
            // 'progress',
            //  'status',
            
            // 'created_by',
            'document',
        ],
    ]) ?>
<?php



// $currentDate = date('m-d-Y');

// if ($model->end_at) {
//     if ($currentDate < $model->end_at) {
//         echo '<span class="alert alert-success">Not Yet Expired</span>';
//     } else {
//         echo '<span class="alert alert-danger">Expired</span>';
//     }
// }
// ?>


<div class="text-muted">
<h3 class="text-muted mt-10"></h3>Alaysis Detail for <?= Html::encode($this->title) ?></h3>

<table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
      <th scope="col">item</th>
      <th scope="col">quantity</th>
      <th scope="col">Unit</th>
      <th scope="col">Unit Price(Cotted)</th>
      <th scope="col">Amount(Cotted)</th>
      <th scope="col">Unit Price(Buying.price)</th>
      <th scope="col">Total Amount(Buying)</th>
      <th scope="col">Unit Profit</th>
      <th scope="col">source</th>
   <!--   <th scope="col">other attachment..</th>-->
      <th scope="col">Prepaired By</th>
      <th scope="col">status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($analysis as $analysis): ?>
    <tr>
      <td><?= $analysis->item ?></td>
      <td><?= $analysis->quantity ?></td>
      <td><?= $analysis->description ?></td>
      <td><?= $analysis->setunit?></td>
      <td><?= $analysis->cotedAmount?></td>
      <td><?= $analysis->unit?></td>
      <td><?= $analysis->cost ?></td>
      <td><?= $analysis->unitprofit ?></td>
      <td><?= $analysis->source?></td>
  
<td>
      <?php
                $createdByUser = User::findOne($analysis->created_by);
                $createdByName = $createdByUser ? $createdByUser->username : 'Unknown';
                echo $createdByName;
            ?>
      </td>
      <td><?=getStatusLabel($analysis->status)?></td>
      <td>
      <?= Html::a('<span class="glyphicon glyphicon-file"></span>', ['request/create', 'analysisId' => $analysis->id], [
    'title' => 'Update',
    'data-method' => 'post',
    'data-pjax' => '0',
]) ?>
      <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['analysis/update', 'id' => $analysis->id], [
            'title' => 'Update',
            'data-method' => 'post',
            'data-pjax' => '0',
        ]) ?>
      </td>
    </tr>
    <?php endforeach; ?>
    <tr>
      
      <td>
      <?php if (Yii::$app->user->can('author')) : ?>

        <?= Html::a('+ Add a document',  [ 'analysis/create', 'projectId' => $model->id]) ?>
        <?php endif;?>

      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>.</td>
    </tr>
    
      <td></td>
      <td></td>
      <td></td>
      <td style="background-color: #f2f2f2;">Total Amount: TSH <?=$projectAmount?></td>
      <td style="background-color: #f2f2f2;">Profit:TSH <?=$profit?></td>
      <td style="background-color: #f2f2f2;">Percentage Profit(%) <?=$profitPerce?>%</td>
      <td style="background-color: #f2f2f2;"></td>
      <td style="background-color: #f2f2f2;"></td>
      <td style="background-color: #f2f2f2;"></td>
    </tr>
  </tbody>
</table>
</div>
<?php
function getStatusLabel($status)
{
    $statusLabels = [
        1 => '<span class="badge badge-success">Approved</span>',
        2 => '<span class="badge badge-warning">Not Approved</span>',
        0 => '<span class="badge badge-secondary">On Process</span>',
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
<center>
<h1 class="text-muted center mt-10" style=" color: blue;">WORK PLAN</h1>
</center>
<div class="text-muted">
<h3 class="text-muted center mt-10">Task creted for this project</h3>

<table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
      <th scope="col">#</th>
      <th scope="col">Task</th>
      <th scope="col">Budget</th>
      <th scope="col">Description</th>
      <th scope="col">Team</th>
      <th scope="col">Start At</th>
      <th scope="col">End At</th>
      <th scope="col">Status</th>
      <td scope="col"></td>
      
    </tr>
  </thead>
  <tbody>
  <?php foreach ($tasks as $task): ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $task->title ?></td>
      <td><?= $task->budget ?></td>
      <td><?= $task->description ?></td>
      <td><?= $task->team->name?></td>
      <td><?= Yii::$app->formatter->asDatetime($task->start_at) ?></td>
      <td><?= Yii::$app->formatter->asDatetime($task->end_at) ?></td>
      <td><?=getStatusLabel($task->status)?></td>

      <td>
               
                <?= Html::a('<span class="glyphicon glyphicon-share-alt"></span>', ['task/create', 'projectId' => $model->id], [
                    'title' => 'view',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
            </td>
    

    </tr>
    <?php endforeach; ?>
    <tr>
      <td>
      <?php if (Yii::$app->user->can('author')) : ?>
        <?= Html::a('+ Add a line', ['task/create', 'projectId' => $model->id]) ?>
      <?php endif;?>
    </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
</div>



<!--REquests for this project-->


<center>
<h1 class="text-muted center mt-10" style=" color: blue;">REQUEST/PAYMENT VOUCHER</h1>
</center>
<table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
  
      <th scope="col">item</th>
      <th scope="col">ref no</th>
      <th scope="col">Amount</th>
      <th scope="col">Created</th>
      <th scope="col">Updated</th>
      <th scope="col">Created By</th>
     
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($request_on as $request): ?>
    <tr>

<td><?= $request->item ?></td>
      <td><?= $request->ref ?></td>
      <td><?= $request->amount ?></td>
      <td><?= Yii::$app->formatter->asDatetime($request->created_at) ?></td>
      <td><?= Yii::$app->formatter->asDatetime($request->updated_at) ?></td>
      <?php 
      $user=User::findOne($request->created_by);
      ?>
      <td><?= $user->username ?></td>
      <td><?=getStatusLabel($request->status)?></td>
      <td>
        <!--
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $request->id], [
                    'title' => 'Delete',
                    'data-confirm' => 'Are you sure you want to delete this updates',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
          
                <?= Html::a('<span class="glyphicon glyphicon-eye-0"></span>', [ 'request/create' , 'taskId'=> $model->id], [
                    'title' => 'Update',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
        -->
            </td>
    

    </tr>
    <?php endforeach; ?>
    
    <tr>
      <td>
      
      <?php if(Yii::$app->user->can('admin')) :?>
      <?= Html::a('-> View Requests',  [ 'request/create' , 'taskId'=> $model->id]) ?>
      <?php endif;?>
    </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
</div>


        </div>





