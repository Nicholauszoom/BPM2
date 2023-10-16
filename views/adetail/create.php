<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Adetail $model */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Adetails', 'url' => ['index']];
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
<div class="adetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users'=>$users,
        'tenderId'=>$tenderId,
        'activity'=>$activity,
    ]) ?>

</div>
    </div>
</div>