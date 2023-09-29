<?php

use app\models\Department;
use app\models\Office;
use app\models\User;
use app\models\UserAssignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tender $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tenders', 'url' => ['index']];
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
<div class="tender-view">

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
            'PE',
            'TenderNo',
            'description',
            [
                'attribute' => 'publish_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // 'expired_at',
            // [
            //     'attribute' => 'status',
            //     'value' => function ($model) {
            //         return getStatusLabel($model->status);
            //     },
            //     'format' => 'raw',
            //     'contentOptions' => function ($model) {
            //         return ['class' => getStatusClass($model->status)];
            //     },
            // ],
            [
                'attribute' => 'expired_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
            'attribute' => 'assigned_to',
            'format' => 'raw',
            'value' => function ($model) {
                $assignments = UserAssignment::find()
                    ->where(['tender_id' => $model->id])
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
                'attribute'=>'supervisor',
                'format'=>'raw',
                'value'=>function ($model){
                    $createdByUser = User::findOne($model->supervisor);
                    $createdByName = $createdByUser ? $createdByUser->username : 'Unknown';
                     return $createdByName;
                },
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // 'created_at',
            // 'updated_at',
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
                'attribute' => 'document',
                'format' => 'raw',
                'value' => function ($model) {
                    $fileName = $model->document;
                    $filePath = Yii::getAlias('@webroot/upload/' . $fileName);
                    $downloadPath = Yii::getAlias('@web/upload/' . $fileName);
                    return $model->document ? Html::a('<i class="fa fa-download"></i> Download tender Attachments', $downloadPath, ['class' => 'btn btn-primary', 'target' => '_blank']) : '';
                },
            ],

            [
                'attribute' => 'submission',
                'format' => 'raw',
                'value' => function ($model) {
                    $fileName = $model->submission;
                    $filePath = Yii::getAlias('@webroot/upload/' . $fileName);
                    $downloadPath = Yii::getAlias('@web/upload/' . $fileName);
                    return $model->submission ? Html::a('<i class="fa fa-download"></i> complete tender submitted document', $downloadPath, ['class' => 'btn btn-warning', 'target' => '_blank']) : '';
                },
            ],
            // [
            //     'attribute' => 'submission',
            //     'format' => 'raw',
            //     'value' => function ($model) {
            //         return $model->submission ? Html::a('<i class="fa fa-download"></i> complete tender submitted document', Url::to($model->submission), ['class' => 'btn btn-warning']) : '';
            //     },
            // ],
            [
                'attribute'=>'submit_to',
                'format'=>'raw',
                'value'=>function ($model){
                    $department = Department::findOne($model->submit_to);
                    $departmentName =  $department ?  $department ->name : 'Unknown';
                     return $departmentName;
                },
            ],
            // 'created_by',
            // 'document',
        ],
    ]) ?>




</div>


<center>
<h1 class="text-muted center mt-10" style=" color: blue;">More Details</h1>
</center>


<table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
      <th scope="col">#</th>
      <th scope="col">Tender Security</th>
      <th scope="col">Bid Security Amount(tsh)</th>
      <th scope="col">Bid Security Percent(%)</th>
      <th scope='col'>Bid Meet Date</th>
      <th scope="col">End Clarification Date</th>
      <th scope='col'>Site visit date</th>
      <th scope='col'>Office</th>
      <td scope="col"></td>
      
    </tr>
  </thead>
  <tbody>
  <?php foreach ($tdetail as $tdetail): ?>
    <tr>
      <th scope="row">1</th>
      <td><?=getSecurityLabel($tdetail->tender_security)?></td>

      <td><?=$tdetail->amount?></td>
      <td><?=$tdetail->percentage?></td>

     <td><?= Yii::$app->formatter->asDatetime($tdetail->bidmeet)?></td>

      <td><?= Yii::$app->formatter->asDatetime($tdetail->end_clarificatiion) ?></td>

      <td><?= Yii::$app->formatter->asDatetime($tdetail->site_visit_date) ?></td>
      <?php 
      $office=Office::findOne($tdetail->office);
       $office_loca=$office->location;
      ?>
      <td><?= $office_loca?></td>

      <td>
               
                <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['tdetail/update', 'id'=> $tdetail->id], [
                    'title' => 'edit',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['tdetail/delete', 'id'=> $tdetail->id], [
                    'title' => 'edit',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
            </td>
    

    </tr>
    <?php endforeach; ?>
    <tr>
      <td>
             
      <?= Html::a('+ Add',  [ 'tdetail/create' , 'tenderId'=> $model->id]) ?>
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

<?php
    function getStatusLabel($status)
{
    $statusLabels = [
      1 => '<span class="">YES</span>',
      2 => '<span class="">NO</span>',
     
    ];

    return isset($statusLabels[$status]) ? $statusLabels[$status] : '';
}

function getSecurityLabel($status)
{
    $statusLabels = [
      1 => '<span class="">Security Declaration</span>',
      2 => '<span class="">Bid/Tender Security</span>',
     
    ];

    return isset($statusLabels[$status]) ? $statusLabels[$status] : '';
}


?>