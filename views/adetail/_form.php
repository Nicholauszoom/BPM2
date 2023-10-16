<?php

use app\models\UserActivity;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserActivity $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-activity-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-row">
        <div class="col">
        <?= $form->field($model, 'user_id')->dropDownList(
    ArrayHelper::map($users, 'id', function ($user) {
        $assignActivity = UserActivity::findOne(['user_id' => $user->id]);
        $label = $assignActivity && $assignActivity->assign == 1 ? '<span class="badge badge-success">(assigned)</span> ' : '';
        return $user->username . ' ' . $label;
    }),
    ['prompt' => 'Assigned to', 'id' => 'user-to', 'encode' => false]
) ?>
        </div>
        <div class="col">

        <?= $form->field($model, 'activity_id')->checkboxList(
    ArrayHelper::map($activity, 'id', 'name'),
    ['prompt' => 'Select Activity', 'id' => 'activity']
)?>



        </div>

    </div>
    <?= $form->field($model, 'submit_at')->widget(DatePicker::class, [
    'language' => 'ru',
    'dateFormat' => 'MM/dd/yyyy',
    'options' => [
        'class' => 'form-control',
        'type' => 'date', // Use 'text' type instead of 'date' to ensure consistent behavior across browsers
        // $model->start_at => ['selected' => true]
        'value' => Yii::$app->formatter->asDate($model->submit_at, 'MM/dd/yyyy'), // Set the value of the date picker

    ],
]) ?>

   
    <?= $form->field($model, 'tender_id')->hiddenInput(['value'=>$tenderId])->label(false) ?>

  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
