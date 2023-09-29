<?php

use app\models\Tender;
use kartik\datecontrol\DateControl;
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
    <div class="form-row">
    <div class="col">

    <?= $form->field($model, 'budget')->textInput(['type'=>'number']) ?>
    </div>
    <div class="col mt-4">
    <?= $form->field($model, 'document')->fileInput() ?>
    </div>
    </div>
    <?= $form->field($model, 'tender_id')->hiddenInput(['value' => $tenderId])->label(false)?>

    <div class="form-row">
    <div class="col">
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    </div>
   
    <div class="col">
 <?php echo $form->field($model, 'user_id', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-user'></i></span></div>\n{error}"])->dropDownList(
    ArrayHelper::map($users, 'id', 'username'),
    [
        'prompt' => 'Select Project Manager',
        'options' => [
            $model->user_id => ['selected' => true]
        ]
    ]
); ?>
    </div>
    </div>


<?= $form->field($model, 'start_at')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        // $model->start_at => ['selected' => true]
    ],
]) ?>

<?= $form->field($model, 'end_at')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        // $model->end_at => ['selected' => true]
    ],
]) ?>



    <?php endif;?>
    <div class="form-row">
    <div class="col">
    <?php if(Yii::$app->user->can('author')) :?>

    <?= $form->field($model, 'progress' , ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-pencil'></i></span></div>\n{error}"])->dropDownList([
    '0' => '0%',
    '30' => '30%',
    '50' => '50%',
    '70' => '70%',
    '90' => '90%',
    '100' => '100%',
    
]) ?>


    </div>
    <div class="col">
<?php endif;?>
<?= $form->field($model, 'status' , ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-info'></i></span></div>\n{error}"])->dropDownList(
    [
        1 => 'Completed',
        2 => 'Onpregress',
        3 => 'On Hold',
    ],
    ['prompt' => 'Select Project Status',
    $model->status => ['selected' => true]
    ]
); ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
        </div>
    </div>
</div>
