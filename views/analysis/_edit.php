<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Admin $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="analysis-form-update">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (Yii::$app->user->can('author')) : ?>

    <?= $form->field($model, 'item')->textInput(['maxlength' => true,'disabled'=>true]) ?>

    <?= $form->field($model, 'description')->textinput(['maxlength' => true,'disabled'=>true]) ?>

    <?= $form->field($model, 'setunit')->textInput(['id' => 'setunit','disabled'=>true]) ?>

    <?= $form->field($model, 'source')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput(['id' => 'quantity','disabled'=>true]) ?>

    <?= $form->field($model, 'unit')->textInput(['id' => 'unit']) ?>

 
    
    <?php endif;?>

<?php if (Yii::$app->user->can('admin')) : ?>
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
