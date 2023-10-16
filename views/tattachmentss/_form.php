<?php

use app\models\Tender;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tattachmentss $model */
/** @var yii\widgets\ActiveForm $form */

$tender_attach=Tender::findOne($tenderId);
?>

<div class="tattachmentss-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-row">
        <div class="col">
        <?= $form->field($model, 'document')->fileInput()?>
        </div>
        <div class="col">
    
   


    <?php if ($tender_attach->expired_at <= strtotime(date('Y-m-d'))) : ?>

    <?= $form->field($model, 'evaluation')->fileInput()?>
    </div>

  

</div>

<div class="form-row">

<div class="col">
<?= $form->field($model, 'negotiation')->fileInput()?>
</div>
<div class="col">
<?= $form->field($model, 'award')->fileInput()?>
</div>
</div>

<div class="form-row">
<div class="col">
<?= $form->field($model, 'intention')->fileInput()?>
</div>
<div class="col">
<?= $form->field($model, 'arithmetic')->fileInput()?>
</div>

</div>
  
<div class="form-row">
<div class="col">
<?= $form->field($model, 'audit')->fileInput()?>
</div>
    <div class="col">
    <?= $form->field($model, 'cancellation')->fileInput()?>
    </div>
</div>
 

    
    <?php else:?>
    <?= $form->field($model, 'evaluation')->hiddenInput()?>

    <?= $form->field($model, 'negotiation')->hiddenInput()?>

    <?= $form->field($model, 'award')->hiddenInput()?>

    <?= $form->field($model, 'intention')->hiddenInput()?>

    <?= $form->field($model, 'arithmetic')->hiddenInput()?>

    <?= $form->field($model, 'audit')->hiddenInput()?>

<?php endif;?>

    <?= $form->field($model, 'tender_id')->hiddenInput(['value'=>$tenderId])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
