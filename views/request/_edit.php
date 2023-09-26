<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Role $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(Yii::$app->user->can('author')) :?>
<?= $form->field($model, 'payment')->dropDownList(
  [
      1 => 'Cheque',
      2 => 'Cash',
      
  ],
  ['prompt' => 'Payment Mode']
)?>



<?= $form->field($model, 'department')->dropDownList(
  \yii\helpers\ArrayHelper::map($department, 'id', 'name'),
  ['prompt' => 'Select department',
  'value' => $model->department
  ]
  ) ?>
  
<?= $form->field($model, 'ref')->textInput(['type'=>'number']) ?>

<?= $form->field($model, 'amount')->textInput(['type'=>'number']) ?>
<?php endif;?>
<?php if(Yii::$app->user->can('admin')) :?>

<?= $form->field($model, 'status')->dropDownList(
  [
      1 => 'Accepted',
      2 => 'Refused',
      
  ],
  ['prompt' => 'Have you Accept/Refuse? ']
)?>
<?= $form->field($model, 'description')->textarea() ?>
<?php endif;?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>