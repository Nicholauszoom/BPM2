<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Test $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>
<!--
    <?= $form->field($model, 'Sno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Regno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quiz1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assign2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quiz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'termpaper')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quizassign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quizassgn2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'test1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'test2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'test80')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'test15')->textInput(['maxlength' => true]) ?>
-->
    <?= $form->field($model, 'document')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
