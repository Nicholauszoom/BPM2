<?php

use app\models\Analysis;
use app\models\Project;
use app\models\Team;
use app\models\Tender;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Task $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->context->layout = 'admin';


?>

<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>

<div id="main-content ">
   
    <div id="page-container">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row"></div>
<div class="task-view">

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
            'title',
            'budget',
            'code',
            'description',
            'status',
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
                'attribute'=>'created_by',
                'format'=>'raw',
                'value'=>function ($model){
                    $createdByUser = User::findOne($model->created_by);
                    $createdByName = $createdByUser ? $createdByUser->username : 'Unknown';
                     return $createdByName;
                },
            ],
            [
                'attribute'=>'project_id',
                'format'=>'raw',
                'value'=>function ($model){
                    $project = Project::findOne($model->project_id);
$project_tender = $project ? $project->tender_id : '';
$project_tender_id=Tender::findOne($project_tender);
$projectName = $project_tender_id ? $project_tender_id->title : '';
                     return $projectName;
                },
            ],
            // 'project_id',
            [
                'attribute'=>'team_id',
                'format'=>'raw',
                'value'=>function ($model){
                    $team = Team::findOne($model->team_id);
                    $teamName = $team ? $team->name : 'Unknown';
                     return $teamName;
                },
            ],
            // 'team_id',
        ],
    ]) ?>

</div>
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
  <?php foreach ($request as $request): ?>
    <tr>
    
    <?php 
$analysis = Analysis::findOne($request->item);
$item = $analysis->item;
$wrappedItem = wordwrap($item, 70, "<br>", true);
?>
<td><?= $wrappedItem ?></td>
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
      <?php if(Yii::$app->user->can('author')) :?>
      <?= Html::a('+ create request',  [ 'request/create' , 'taskId'=> $model->id]) ?>
      <?php endif;?>
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


<center>
<h1 class="text-muted center mt-10" style=" color: blue;">UPDATES FOR THIS TASK</h1>
</center>
<table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
    <th scope="col">#</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">Created</th>
      <th scope="col">images</th>
      <th scope="col">Created By</th>
      <th scope="col">status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($updates as $updates): ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $updates->title ?></td>
      <td><?= $updates->description ?></td>
      <td><?= Yii::$app->formatter->asDatetime($updates->created_at) ?></td>
      <td><?=$updates->image?></td>
      <?php $user=User::findOne($updates->created_by)?>
      <td><?=$user->username ?></td>
      <td>
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $updates->id], [
                    'title' => 'Delete',
                    'data-confirm' => 'Are you sure you want to delete this updates',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
                <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['update', 'id' => $updates->id], [
                    'title' => 'Update',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
            </td>
    

    </tr>
    <?php endforeach; ?>
    
    <tr>
      <td>
             
      <?= Html::a('+ Add update',  [ 'update/create' , 'taskId'=> $model->id]) ?>
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
    <?php
    function getStatusLabel($status)
{
    $statusLabels = [
      1 => '<span class="badge badge-success">Accepted</span>',
      2 => '<span class="badge badge-warning">Rejected</span>',
      0 => '<span class="badge badge-secondary">wait...</span>',
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
