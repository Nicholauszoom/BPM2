<?php

use app\models\Tender;
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
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        'id'=> 'site-visit-date-input'
    ],
    'value' => Yii::$app->formatter->asDate($model->site_visit_date, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>

<?php
$tender_by_id = Tender::findOne($tenderId);
$publish_date = $tender_by_id->publish_at;
$submit_date = $tender_by_id->expired_at;

?>
<div id="site-visit-date-warning" style="display: none; color: red;"><i class="fas fa-warning" style="color:orange ;"></i> Date must be between <span style = "color:dimgray;"><?=Yii::$app->formatter->asDatetime($publish_date)?></span>  and <span style = "color:dimgray;"><?=Yii::$app->formatter->asDatetime($submit_date)?></span></div>

</div>


    <?= $form->field($model, 'end_clarificatiion', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-calender'></i></span></div>\n{error}"])->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        'id'=>'clarification-date-input'
    ],
    'value' => Yii::$app->formatter->asDate($model->end_clarificatiion, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>
<?php
$tender_by_id = Tender::findOne($tenderId);
$publish_date = $tender_by_id->publish_at;
$submit_date = $tender_by_id->expired_at;

?>
<div id="clarification-date-warning" style="display: none; color: red;"><i class="fas fa-warning" style="color:orange ;"></i> Date must be between <span style = "color:dimgray;"><?=Yii::$app->formatter->asDatetime($publish_date)?></span>  and <span style = "color:dimgray;"><?=Yii::$app->formatter->asDatetime($submit_date)?></span></div>

    <?= $form->field($model, 'tender_id')->hiddenInput(['value' => $tenderId])->label(false) ?>

    <?= $form->field($model, 'bidmeet', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-calender'></i></span></div>\n{error}"])->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        'id'=> 'bidmeet-date-input'
    ],
    'value' => Yii::$app->formatter->asDate($model->bidmeet, 'MM/dd/yyyy'), // Set the value of the date picker
]) ?>
<?php
$tender_by_id = Tender::findOne($tenderId);
$publish_date = $tender_by_id->publish_at;
$submit_date = $tender_by_id->expired_at;

?>
<div id="bidmeet-date-warning" style="display: none; color: red;"><i class="fas fa-warning" style="color:orange ;"></i> Date must be between <span style = "color:dimgray;"><?=Yii::$app->formatter->asDatetime($publish_date)?></span>  and <span style = "color:dimgray;"><?=Yii::$app->formatter->asDatetime($submit_date)?></span></div>


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



<?php
$tender_by_id = Tender::findOne($tenderId);
$submit_date = $tender_by_id->expired_at;
?>

<script>
// Get the publish date input element
var sitevisitDateInput = document.getElementById('site-visit-date-input');

// Add an event listener to the change event
sitevisitDateInput.addEventListener('change', function() {
  // Get the entered publish date and current date
  var enteredDate = new Date(this.value);
  var currentDate = new Date();
  var submitDate = new Date("<?php echo $submit_date; ?>"); // Convert PHP date to JavaScript date object

  // Format the submitDate to compare it with the entered date
  var formattedSubmitDate = submitDate.toLocaleDateString('en-ru', { year: 'numeric', month: '2-digit', day: '2-digit' });
  // Compare the entered publish date with the current date and submit date
  if (enteredDate < currentDate || enteredDate > formattedSubmitDate ) {
    // Display a warning message
    var warningMessage = document.getElementById('site-visit-date-warning');
    warningMessage.style.display = 'block';
  } else {
    // Hide the warning message
    var warningMessage = document.getElementById('site-visit-date-warning');
    warningMessage.style.display = 'none';
  }
});

//bidmeet date script
//Get the submit date input element
var bidMeetDateInput = document.getElementById('bidmeet-date-input');

// Add an event listener to the change event
bidMeetDateInput .addEventListener('change', function() {
  // Get the entered publish date and current date
  var enterBidDate = new Date(this.value);
  var currentDate = new Date();

//   Remove the time information from the current date
  currentDate.setHours(0, 0, 0, 0);

  // Compare the entered publish date with the current date
  if (enterBidDate < currentDate) {
    // Display a warning message
    var warningMessage = document.getElementById('bidmeet-date-warning');
    warningMessage.style.display = 'block';
  } else {
    // Hide the warning message
    var warningMessage = document.getElementById('bidmeet-date-warning');
    warningMessage.style.display = 'none';
  }

});



//end clarification date script
//Get the submit date input element
var clarificationDateInput = document.getElementById('clarification-date-input');

// Add an event listener to the change event
clarificationDateInput .addEventListener('change', function() {
  // Get the entered publish date and current date
  var enterClarifDate = new Date(this.value);
  var currentDate = new Date();

//   Remove the time information from the current date
  currentDate.setHours(0, 0, 0, 0);

  // Compare the entered publish date with the current date
  if (enterClarifDate  < currentDate) {
    // Display a warning message
    var warningMessage = document.getElementById('clarification-date-warning');
    warningMessage.style.display = 'block';
  } else {
    // Hide the warning message
    var warningMessage = document.getElementById('clarification-date-warning');
    warningMessage.style.display = 'none';
  }

});


</script>