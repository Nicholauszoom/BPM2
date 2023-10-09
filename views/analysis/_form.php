<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Analysis $model */
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

// echo $form->field($model, 'item')->textInput(['maxlength' => true]);
// echo $form->field($model, 'quantity')->textInput();
// echo $form->field($model, 'description')->textarea(['maxlength' => true]);
// echo $form->field($model, 'source')->textarea(['maxlength' => true]);
// echo $form->field($model, 'unit')->textInput();
// echo $form->field($model, 'setunit')->textInput();

// echo $form->field($model, 'cost')->textInput(['readonly' => true]);
// // echo $form->field($model, 'boq')->fileInput();
echo $form->field($model, 'files')->fileInput();
// echo $form->field($model, 'project')->hiddenInput(['value' => $projectId])->label(false);
// echo $form->field($model, 'unitprofit')->hiddenInput()->label(false);
// Add remaining form fields...

echo '<div class="modal-footer">';
echo Html::submitButton('Save', ['class' => 'btn btn-success','id' => 'save-button']);
echo '</div>';

ActiveForm::end();

Modal::end();


 

?>

<div class="analysis-form">


    <table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
    <th scope="col">#</th>
      <th scope="col">item</th>
      <th scope="col">quantity</th>
      <th scope="col">Unit</th>
      <th scope="col">Unit Price(Cotted)</th>
      <th scope="col">Cotted Amount</th>
      <th scope="col">Amount(TSH)</th>
      <th scope="col">Unit Price(Buying)</th>
      <th scope="col">Unit Profit</th>
      <th scope="col">source</th>
      <th scope="col">status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($details as $details): ?>
    <tr>
    <td><?= $details->serio ?></td>
      <td><?= $details->item ?></td>
      <td><?= $details->quantity ?></td>
      <td><?= $details->description ?></td>
      <td><?= $details->setunit?></td>
      <td><?= $details->cotedAmount?></td>
      <td><?= $details->unit?></td>
      <td><?= $details->cost?></td>
      <td><?= $details->unitprofit?></td>
      <td><?= $details->source?></td>
      <td><?= getStatusLabel($details->status)?></td>
      <td>
      <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $details->id], [
            'title' => 'Delete',
            'data-confirm' => 'Are you sure you want to delete this item?',
            'data-method' => 'post',
            'data-pjax' => '0',
        ]) ?>
         <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['update', 'id' => $details->id], [
            'title' => 'Update',
            'data-method' => 'post',
            'data-pjax' => '0',
        ]) ?>
    </td>

    </tr>
    <?php endforeach; ?>

    <tr>
      <td>

      <?= Html::a('+ Add (CSV/EXEL) document', '#', [ 'data-toggle' => 'modal', 'data-target' => '#createModal']) ?>
    </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="font-weight:bold;">TOTAL AMOUNT BEFORE VAT:</td>
      <td> <?=$projectAmount + $vat?></td>
      <td></td>
      <td></td>
      <td ></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="font-weight:bold;">TOTAL AMOUNT INCLUDING VAT:</td>
      <td> <?=$projectAmount?></td>
      <td></td>
      <td></td>
      <td ></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>

    <tr>
      <td></td>
      <td></td>
      <td style="font-weight:bold;">VAT</td>
      <td >18%</td>
      <td ><?=$vat?></td>
      <td ></td>
      <td ></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="font-weight:bold;">Profit:</td>
      <td ><?=$profit?></td>
      <td ></td>
      <td ></td>
      <td ></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="font-weight:bold;">Percentage Profit(%)</td>
      <td > <?=$profitPerce?>%</td>
      <td ></td>
      <td ></td>
      <td ></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>


<?php
function getStatusLabel($status)
{
    $statusLabels = [
      1 => '<span class="badge badge-success">Approved</span>',
      2 => '<span class="badge badge-warning">Not Approved</span>',
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
<style>
  .logo-cell {
    background-image: url('/images/tera_inc.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    opacity: 0.5; /* Adjust the opacity value to make the image transparent */
}
</style>
