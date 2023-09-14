<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Analysis $model */

$this->title = 'Update Analysis: ' . $model->item;
$this->params['breadcrumbs'][] = ['label' => 'Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->context->layout = 'admin';
?>
<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>
<div class="analysis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_edit', [
        'model' => $model,
        'projectId' => $model->project,
        'details' =>$details,
        // 'projectAmount'=>$projectAmount,
        // 'profit'=>$profit,
        // 'profitPerce'=>$profitPerce,
    ]) ?>

</div>
