<?php

// use yii\bootstrap\BootstrapAsset;
// use yii\bootstrap5\BootstrapAsset;

// BootstrapAsset::register($this);
// BootstrapAsset::register($this);

use app\models\Department;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
// use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tender $model */
/** @var yii\widgets\ActiveForm $form */
// $this->registerAssetBundle(BootstrapAsset::class);
$users=User::find()->all();
$department=Department::find()->all();
?>

<div class="tender-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if (Yii::$app->user->can('admin')) : ?>
        <div class="form-row">
    <div class="col">
        <?= $form->field($model, 'title', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-pencil'></i></span></div>\n{error}"])->textInput(['maxlength' => true, 'placeholder'=>''])->label('Title') ?>
    </div>
    <div class="col">
    <?= $form->field($model, 'PE', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-home'></i></span></div>\n{error}"])->textInput(['maxlength' => true, 'placeholder' => ''])->label('Procurement Entity') ?>
</div>
    <div class="col">
        <?= $form->field($model, 'TenderNo', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-terminal'></i></span></div>\n{error}"])->textInput(['maxlength' => true,'placeholder'=>''])->label('Tender Number') ?>
    </div>
</div>


    <div class="form-row">
    <div class="col">
    <?php echo $form->field($model, 'assigned_to')->checkboxList(
    ArrayHelper::map($users, 'id', 'username'),
    [
        'showDropdown' => true,
        'prompt' => 'Assigned to',
    ]
); ?>
  </div>
    <div class="col mt-3">
<?= $form->field($model, 'document')->fileInput()?>
    </div>
</div>
    
<div class="form-row">
    <div class="col">
 <?php echo $form->field($model, 'supervisor', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-user'></i></span></div>\n{error}"])->dropDownList(
    ArrayHelper::map($users, 'id', 'username'),
    ['prompt' => 'Supervisor',
    
    ]
); ?>
    </div>
    <div class="col">
    
    <?php endif; ?>
 

<?php if (Yii::$app->user->can('admin')) : ?>
    
    
    <?= $form->field($model, 'status', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-info'></i></span></div>\n{error}"])->dropDownList(
            [
                1 => 'awarded',
                2 => 'not-awarded',
                3 => 'submitted',
                4 => 'not submitted',
                5 => 'on-progress',
            ],
            ['prompt' => 'Select tender Status'] // Disable the field if the expiration date is not greater than the current date

        ); ?>
<?php endif; ?>
</div>
</div>

<?php if (Yii::$app->user->can('admin')) : ?>
<?= $form->field($model, 'description')->textarea(['placeholder'=>'add description..'])?>

<?= $form->field($model, 'publish_at')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
    ],
    'value' => Yii::$app->formatter->asDate($model->expired_at, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>

<?= $form->field($model, 'expired_at')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
    ],
    'value' => Yii::$app->formatter->asDate($model->expired_at, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>
<?php endif; ?>
    <?php if (Yii::$app->user->can('author')) : ?>

    <?= $form->field($model, 'submission')->fileInput()?>
    <?php echo $form->field($model, 'submit_to')->dropDownList(
    ArrayHelper::map($department, 'id', 'name'),
    ['prompt' => 'Department document to be submitted']
); ?>

<?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
