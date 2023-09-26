<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\jui\DatePicker;
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




echo $form->field($model, 'title')->textInput(['maxlength' => true]) ;

echo $form->field($model, 'description')->textarea() ;

echo $form->field($model, 'image')->fileInput() ;
echo $form->field($model, 'task_id')->hiddenInput(['value' => $taskId])->label(false);





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
    <th scope="col">id</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">Created</th>
      <th scope="col">Updated</th>
      <th scope="col">Updated By</th>
     
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($updates as $updates): ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $updates->title ?></td>
      <td><?= $updates->description ?></td>
      <td><?= Yii::$app->formatter->asDatetime($updates->created_at) ?></td>
      <td><?= Yii::$app->formatter->asDatetime($updates->updated_at) ?></td>
      <td><?= $updates->created_by ?></td>
      <td>
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $updates->id], [
                    'title' => 'Delete',
                    'data-confirm' => 'Are you sure you want to delete this updates',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
                <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['update', 'id' => $updates->id], [
                    'title' => 'Update',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>
            </td>
    

    </tr>
    <?php endforeach; ?>
    
    <tr>
      <td>
             
      <?= Html::a('+ Add a update', '#', [ 'data-toggle' => 'modal', 'data-target' => '#createModal']) ?>
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


