<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserActivity $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
    ArrayHelper::map($users, 'id', 'username'),
    ['prompt' => 'Assigned to', 'id' => 'user-to']
)?>


    <?= $form->field($model, 'activity_id')->checkboxList(
    ArrayHelper::map($activity, 'id', 'name'),
    ['prompt' => 'Select Activity', 'id' => 'activity']
)?>


    <?= $form->field($model, 'tender_id')->hiddenInput(['value'=>$tenderId])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
