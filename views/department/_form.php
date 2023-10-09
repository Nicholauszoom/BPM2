<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Department $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="form-row">
    <div class="col">
    <?= $form->field($model, 'name', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-pencil'></i></span></div>\n{error}"])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col">
    <?= $form->field($model, 'email', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-at'></i></span></div>\n{error}"])->textInput(['maxlength' => true]) ?>
    </div>
</div>
   


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
