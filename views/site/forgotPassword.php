<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'forgot-password-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Send Reset Link', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>