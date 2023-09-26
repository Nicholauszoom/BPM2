<?php

use app\models\Task;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Updates $model */

// $this->title = 'Create Updates';

$this->context->layout = 'admin';


$task = Task::findOne($taskId);

$taskName = $task ? $task->title : '';
$this->title = 'Create Updates for :' . $taskName . ' task';
$this->params['breadcrumbs'][] = ['label' => 'Updates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
<div class="updates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'taskId'=>$taskId,
        'updates'=>$updates
    ]) ?>

</div>
    </div>
</div>

