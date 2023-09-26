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
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TenderNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea()?>


    <?php echo $form->field($model, 'assigned_to')->checkboxList(
    ArrayHelper::map($users, 'id', 'username'),
    [
        'showDropdown' => true,
        'prompt' => 'Assigned to',
    ]
); ?>
 <?php echo $form->field($model, 'supervisor')->dropDownList(
    ArrayHelper::map($users, 'id', 'username'),
    ['prompt' => 'Supervisor',
    
    ]
); ?>


    <?= $form->field($model, 'document')->fileInput()?>

  
    <?php endif; ?>
 

<?php if (Yii::$app->user->can('admin')) : ?>
    
    
    <?= $form->field($model, 'status')->dropDownList(
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
<?php if (Yii::$app->user->can('admin')) : ?>
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
