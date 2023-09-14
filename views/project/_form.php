<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;


use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use Yii;
use yii\jui\DatePicker;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
 // Register jQuery UI from an online source
// $this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', ['position' => View::POS_HEAD]);
// $this->registerCssFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
// $this->context->layout = 'admin';
// DatePickerAsset::register($this);

// $this->registerJs("
// $(document).ready(function() {
//     $('#datepicker-start').datepicker({
//         dateFormat: 'yy-mm-dd',
//     });
//     $('#datepicker-end').datepicker({
//         dateFormat: 'yy-mm-dd',
//     });
// });

// jQuery('#w0').yiiActiveForm([
//     // ... your other validation rules here ...
// ]);
// ");


    

?>

<div id="main-content">
    <div id="header">
        <div class="header-left float-left">
            <i id="toggle-left-menu" class="ion-android-menu"></i>
        </div>
        <div class="header-right float-right">
            <i class="ion-ios-people"></i>
        </div>
    </div>

    <div id="page-container">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row">

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>
   <?php if(Yii::$app->user->can('admin')) :?>

    <!--<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'budget')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document')->fileInput() ?>

    <?php echo $form->field($model, 'tender_id')->dropDownList(
    ArrayHelper::map($details, 'id', 'title'),
    ['prompt' => 'Select tender ']
); ?>

    <?php echo $form->field($model, 'user_id')->dropDownList(
    ArrayHelper::map($users, 'id', 'username'),
    ['prompt' => 'Select Project Manager']
); ?>


<?= $form->field($model, 'start_at')->widget(\yii\jui\DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => ['class' => 'form-control', 'type' => 'date'],
]) ?>
<?= $form->field($model, 'end_at')->widget(\yii\jui\DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => ['class' => 'form-control', 'type' => 'date'],
]) ?>

    <?php endif;?>

    <?php if(Yii::$app->user->can('author')) :?>

    <?= $form->field($model, 'progress')->dropDownList([
    '0' => '0%',
    '30' => '30%',
    '50' => '50%',
    '70' => '70%',
    '90' => '90%',
    '100' => '100%',
    
]) ?>



<?php endif;?>
<?= $form->field($model, 'status')->dropDownList(
    [
        1 => 'Completed',
        2 => 'Onpregress',
        3 => 'On Hold',
    ],
    ['prompt' => 'Select Project Status']
); ?>
 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
        </div>
    </div>
</div>
