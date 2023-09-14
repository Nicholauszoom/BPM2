<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Admin $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form-update">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (Yii::$app->user->can('author')) : ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'budget')->textInput() ?> 
     

    <?= $form->field($model, 'status')->dropDownList(
    [
        1 => 'Approved',
        0 => 'On Process',
        2 => 'Not Approved',
        
    ],
    ['prompt' => 'Select Project Status']
); ?>

<?php endif;?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
