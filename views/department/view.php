<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Department $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->context->layout = 'admin';
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
<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>

<div id="main-content ">
   
    <div id="page-container">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row"></div>
<div class="department-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->can('admin')) : ?>
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
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email',
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
        ],
    ]) ?>



<h3 class="display-6">Users creted for this Department</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Sallary</th>
      
    </tr>
  </thead>
  <tbody>
  <?php foreach ($user as $user): ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $user->username ?></td>
      <td><?= $user->email ?></td>
      <td>------</td>
      

    </td>

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>





<h3 class="display-6">Tender details for this department</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tender Title</th>
      <th scope="col">Tender Complete Submitted Documents</th>
      <th scope="col">Tender Submitted by</th>
      <th scope="col">Tender Submitted date</th>
      
    </tr>
  </thead>
  <tbody>
  <?php foreach ($tender as $tender): ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $tender->title ?></td>
      <td>
      <?php if (!empty($tender->submission)) : ?>
        <a href="<?= Yii::$app->urlManager->baseUrl . 'upload/' . $tender->submission ?>" download><?=$tender->submission?></a>
    <?php else : ?>
        No document available
    <?php endif; ?></td>
      <td>
        <?php
        $user=User::findOne($tender->assigned_to)
        ?>
        
      <?= $user->username?>
    
    </td>
    <td><?= Yii::$app->formatter->asDatetime($tender->updated_at) ?></td>
      

    </td>

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
    </div>
</div>