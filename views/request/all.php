<?php

use app\models\Analysis;
use app\models\Request;
use app\models\User;
use yii\bootstrap5\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
$this->context->layout = 'admin';

?>



<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>

<div id="main-content ">


   <div id="page-container">
       <!-- ============================================================== -->
       <!-- Sales Cards  -->
       <!-- ============================================================== -->
       <div class="row"></div>

<div class="task-form">


<table class="table">
  <thead>
    <tr style="background-color: #f2f2f2;">
  
      <th scope="col">item</th>
      <th scope="col">ref no</th>
      <th scope="col">Amount</th>
      <th scope="col">Created</th>
      <th scope="col">Updated</th>
      <th scope="col">Created By</th>
      <th scope="col">Approved/Not</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
    </thead>
<tbody>
<?php foreach ($req as $request): ?>
    <tr>
        <?php 
        $analysis = Analysis::findOne($request->analysis_id);
        $item = $analysis->item;
        $wrappedItem = wordwrap($item, 70, "<br>", true);
        ?>
        <td><?= $wrappedItem ?></td>
        <td><?= $request->ref ?></td>
        <td><?= $request->amount ?></td>
        <td><?= Yii::$app->formatter->asDatetime($request->created_at) ?></td>
        <td><?= Yii::$app->formatter->asDatetime($request->updated_at) ?></td>
        <?php 
        $user = User::findOne($request->created_by);
        ?>
        <td><?= $user->username ?></td>
        <td><?= getStatusLabel($request->status) ?></td>
        <td>
    <?php if ($request->viewed == 0): ?>
        <span class="badge bg-blue">New</span>
    <?php else: ?>
        <span class="badge bg-green">Viewed</span>
    <?php endif; ?>
</td>
       
        <td>
                <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['update', 'id' => $request->id], [
                    'title' => 'Update',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>

                <?= Html::a('<span class="fa fa-commenting" style="font-size: 20px;"></span>', ['update', 'id' => $request->id], [
                    'title' => 'for Approve',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]) ?>

            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $request->id], [
                'title' => 'Delete',
                'data-confirm' => 'Are you sure you want to delete this updates',
                'data-method' => 'post',
                'data-pjax' => '0',
            ]) ?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
      <td></td>
      <td></td>
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
      1 => '<span class="badge badge-success">Accepted</span>',
      2 => '<span class="badge badge-warning">Reject</span>',
      0 => '<span class="badge badge-secondary">wait...</span>',
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





   </div>
</div>



