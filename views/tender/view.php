<?php

use app\models\Department;
use app\models\User;
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
            'budget',
            [
                'attribute' => 'published_at',
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
                'attribute'=>'assigned_to',
                'format'=>'raw',
                'value'=>function ($model){
                    $createdByUser = User::findOne($model->assigned_to);
                    $createdByName = $createdByUser ? $createdByUser->username : 'Unknown';
                     return $createdByName;
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
                    return $model->document ? Html::a('<i class="fa fa-download"></i> Download tender Attachments', Url::to($model->document), ['class' => 'btn btn-primary']) : '';
                },
            ],
            [
                'attribute' => 'submission',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->submission ? Html::a('<i class="fa fa-download"></i> complete tender submitted document', Url::to($model->submission), ['class' => 'btn btn-warning']) : '';
                },
            ],
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



<?php
function getStatusLabel($status)
{
    $statusLabels = [
        1 => '<span class="badge badge-success">Win</span>',
        2 => '<span class="badge badge-warning">fail</span>',
        3 => '<span class="badge badge-secondary">pending</span>',


        
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
