<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Sno') ?>

    <?= $form->field($model, 'Regno') ?>

    <?= $form->field($model, 'quiz1') ?>

    <?= $form->field($model, 'assign2') ?>

    <?php // echo $form->field($model, 'quiz') ?>

    <?php // echo $form->field($model, 'termpaper') ?>

    <?php // echo $form->field($model, 'quizassign') ?>

    <?php // echo $form->field($model, 'quizassgn2') ?>

    <?php // echo $form->field($model, 'test1') ?>

    <?php // echo $form->field($model, 'test2') ?>

    <?php // echo $form->field($model, 'test80') ?>

    <?php // echo $form->field($model, 'test15') ?>

    <?php // echo $form->field($model, 'testassign') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
