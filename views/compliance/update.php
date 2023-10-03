<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Compliance $model */

$this->title = 'Update Compliance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Compliances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="compliance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
