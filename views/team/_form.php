<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Team $model */
/** @var yii\widgets\ActiveForm $form */
$this->context->layout = 'admin';

?>




<div class="team-form">

    <?php $form = ActiveForm::begin(); ?>


 

<?= $form->field($model, 'project_id')->hiddenInput(['value' => $projectId])->label(false)?>

 

<div class="form-row">
    <div class="col">
<?= $form->field($model, 'team_no', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-group'></i></span></div>\n{error}"])->dropDownList(
    [
        1 => 'a. NO',
        2 => 'b. YES',
    ],
    [
        'id' => 'tender-security-dropdown',
        'prompt' => 'Project requires a team ?',
    ]
) ?>
<div id="add-form" style="display: none;">
    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'name', ['template' => "{label}\n<div class='input-group'>{input}\n<span class='input-group-addon'><i class='fa fa-pencil'></i></span></div>\n{error}"])->textInput(['placeholder'=>'team name'])->label() ?>
        </div>
        <div class="col">
    <?= $form->field($model, 'status')->dropDownList(
    [
        1 => 'Active',
        2 => 'Inactive',
        3 => 'On Hold',
    ],
    ['prompt' => 'Select Team Status']
); ?>    
    </div>
        <div class="col">

        <?= $form->field($model, 'user_id')->checkboxList(
    \yii\helpers\ArrayHelper::map($userList, 'id', 'username')
) ?>

    </div>
   
    </div>
</div>
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
