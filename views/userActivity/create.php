<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserActivity $model */

$this->title = 'Create User Activity';
$this->params['breadcrumbs'][] = ['label' => 'User Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
<div class="user-activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tenderId'=>$tenderId,
        'users'=>$users,
        'activity'=>$activity,
    ]) ?>

</div>
    </div>
</div>
