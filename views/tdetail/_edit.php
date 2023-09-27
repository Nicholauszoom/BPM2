<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Tdetails $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="tdetails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'site_visit', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-bell'></i></span></div>\n{error}"])->dropDownList(
    [
        1 => 'a. YES',
        2 => 'b. NO',
    ],
    [
        'id' => 'site-visit-dropdown',
        'prompt' => 'Tender requires site visit?',
    ]
) ?>
<div id="additional-form" style="display: none;">
<?= $form->field($model, 'site_visit_date', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-calender'></i></span></div>\n{error}"])->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
         // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
    ],
    'value' => Yii::$app->formatter->asDate($model->site_visit_date, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>
</div>


    <?= $form->field($model, 'end_clarificatiion', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-calender'></i></span></div>\n{error}"])->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
         // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
    ],
    'value' => Yii::$app->formatter->asDate($model->end_clarificatiion, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>


    <?= $form->field($model, 'bidmeet', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-calender'></i></span></div>\n{error}"])->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
         // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        'readonly' => true,
    ],
    'value' => Yii::$app->formatter->asDate($model->bidmeet, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>

<div class="form-row">
    <div class="col">
<?= $form->field($model, 'tender_security', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-shield'></i></span></div>\n{error}"])->dropDownList(
    [
        1 => 'a. Security Declaration',
        2 => 'b. Bid/Tender Security',
    ],
    [
        'id' => 'tender-security-dropdown',
        'prompt' => 'Select security type',
    ]
) ?>
<div id="add-form" style="display: none;">
    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'amount', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-'></i></span></div>\n{error}"])->textInput(['type'=>'number','placeholder'=>'TSH'])->label(false) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'percentage', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-percent'></i></span></div>\n{error}"])->textInput(['type'=>'number','placeholder'=>'%'])->label(false) ?>
        </div>
    </div>
</div>
    </div>
    <div class="col">
    
    <?php echo $form->field($model, 'office', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-building'></i></span></div>\n{error}"])->dropDownList(
    ArrayHelper::map($office, 'id', function ($item) {
        return '<i class="fas fa-map-marker-alt" style="color: blue;"></i> ' . $item['location'];
    }),
    [
        'prompt' => '<i class="glyphicon glyphicon-envelope" style="color: blue;"></i> Office',
        'encode' => false, // Prevents HTML entities from being encoded
        'class' => 'form-control', // Add the desired CSS class for styling
    ]
); ?>
    </div>
</div>

     <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// Embed the JavaScript code
$script = <<< JS
// Listen for changes in the site_visit dropdown
$('#site-visit-dropdown').on('change', function() {
    var selectedValue = $(this).val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 1) {
        $('#additional-form').show();
    } else {
        $('#additional-form').hide();
    }
});

// Check the initial value of the site_visit dropdown on page load
$(document).ready(function() {
    var selectedValue = $('#site-visit-dropdown').val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 1) {
        $('#additional-form').show();
    } else {
        $('#additional-form').hide();
    }
});


$('#tender-security-dropdown').on('change', function() {
    var selectedValue = $(this).val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 2) {
        $('#add-form').show();
    } else {
        $('#add-form').hide();
    }
});

// Check the initial value of the site_visit dropdown on page load
$(document).ready(function() {
    var selectedValue = $('#tender-security-dropdown').val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 2) {
        $('#add-form').show();
    } else {
        $('#add-form').hide();
    }
});
JS;

$this->registerJs($script);
?>
