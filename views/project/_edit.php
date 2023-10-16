<?php

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

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'budget')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'document')->fileInput() ?>

    <?php echo $form->field($model, 'tender_id')->dropDownList(
    ArrayHelper::map($details, 'id', 'title'),
    [
        'prompt' => 'Select tender',
        'value' => $model->tender_id
    ]
); ?>

<?php echo $form->field($model, 'user_id')->dropDownList(
    ArrayHelper::map($users, 'id', 'username'),
    [
        'prompt' => 'Select Project Manager',
        'options' => [
            $model->user_id => ['selected' => true]
        ]
    ]
); ?>

<?php endif;?>

<?php if(Yii::$app->user->can('author')) :?>

<?= $form->field($model, 'start_at')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options' => [
        'class' => 'form-control',
        // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        // $model->start_at => ['selected' => true]
    ],
]) ?>

<?= $form->field($model, 'end_at')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options' => [
        'class' => 'form-control',
        // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        // $model->end_at => ['selected' => true]
    ],
]) ?>

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
    ['prompt' => 'Select Project Status',
    $model->status => ['selected' => true]
    ]
); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
        </div>
    </div>
</div>
