<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AnalysisSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="analysis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

   

    <?= $form->field($model, 'item') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'boq') ?>

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
