<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Tdetails $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="tdetails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'site_visit')->dropDownList(
    [
        1 => 'YES',
        2 => 'NO',
    ],
    [
        'id' => 'site-visit-dropdown',
        'prompt' => 'Tender requires site visit?',
    ]
) ?>
<div id="additional-form" style="display: none;">
<?= $form->field($model, 'site_visit_date')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
    ],
    'value' => Yii::$app->formatter->asDate($model->site_visit_date, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>
</div>


    <?= $form->field($model, 'end_clarificatiion')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
    ],
    'value' => Yii::$app->formatter->asDate($model->end_clarificatiion, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>

    <?= $form->field($model, 'tender_id')->hiddenInput(['value' => $tenderId])->label(false) ?>

    <?= $form->field($model, 'bidmeet')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
    ],
    'value' => Yii::$app->formatter->asDate($model->bidmeet, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>

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
JS;

$this->registerJs($script);
?>
