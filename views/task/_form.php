<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */


// Modal pop-up
Modal::begin([
    'id' => 'createModal',
    'title' => 'Create',
]);

// Header
echo '<div class="modal-header">';
echo '</div>';

// Form
$form = ActiveForm::begin([
   
]);

echo $form->field($model, 'title')->textInput(['maxlength' => true]);
echo $form->field($model, 'budget')->textInput();
echo $form->field($model, 'code')->textInput(['maxlength' => true]);
echo $form->field($model, 'description')->textarea(['rows' => 6]);
echo $form->field($model, 'project_id')->hiddenInput(['value' => $projectId])->label(false);
echo $form->field($model, 'team_id')->dropDownList(
    \yii\helpers\ArrayHelper::map($teamList, 'id', 'name'),
    ['prompt' => 'Select Team']
);
echo $form->field($model, 'status')->dropDownList(
    [
        1 => 'Complete',
        2 => 'Not Complete',
        0 => 'On Process',
    ],
    ['prompt' => 'Select Team Status']
);
// Add remaining form fields...

echo '<div class="modal-footer">';
echo Html::submitButton('Save', ['class' => 'btn btn-success']);
echo '</div>';

ActiveForm::end();

Modal::end();
?>

<div class="task-form">


<table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
      
      <th scope="col">title</th>
      <th scope="col">budget</th>
      <th scope="col">code</th>
      <th scope="col">description</th>
      <th scope="col">team</th>
      <th scope="col">status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($tasks as $task): ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $task->title ?></td>
      <td><?= $task->budget ?></td>
      <td><?= $task->description ?></td>
      <td><?= $task->team->name?></td>
      <td><?=getStatusLabel($task->status)?></td>
      <td>
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $task->id], [
                    'title' => 'Delete',
                    'data-confirm' => 'Are you sure you want to delete this task',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
                <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['update', 'id' => $task->id], [
                    'title' => 'Update',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
            </td>
    

    </tr>
    <?php endforeach; ?>
    
    <tr>
      <td>
             
      <?= Html::a('+ Add a activity', '#', [ 'data-toggle' => 'modal', 'data-target' => '#createModal']) ?>
    </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>

<!--
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
                -->

    <?php
function getStatusLabel($status)
{
    $statusLabels = [
      1 => '<span class="badge badge-success">Complete</span>',
      2 => '<span class="badge badge-warning">Not Complete</span>',
      0 => '<span class="badge badge-secondary">On Process</span>',
    ];

    return isset($statusLabels[$status]) ? $statusLabels[$status] : '';
}

function getStatusClass($status)
{
    $statusClasses = [
       
        1 => 'status-active',
        2 => 'status-inactive',
        3 => 'status-onhold',
    ];

    return isset($statusClasses[$status]) ? $statusClasses[$status] : '';
}
?>
</div>
