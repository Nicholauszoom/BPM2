<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Compliance $model */

$this->title = 'Create Compliance';
$this->params['breadcrumbs'][] = ['label' => 'Compliances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compliance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
