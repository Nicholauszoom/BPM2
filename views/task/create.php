<?php

use app\models\Project;
use app\models\Tender;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */


// $this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = 'admin';

$project = Project::findOne($projectId);
$project_tender = $project ? $project->tender_id : '';
$project_tender_id=Tender::findOne($project_tender);
$projectName = $project_tender_id ? $project_tender_id->title : '';
$this->title = 'Create Work Plann for :' . $projectName . ' Project';

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

        <div class="task-index mx-0">
<div class="task-create">

    <h1 style="color:lightseagreen"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'projectList'=> $projectList,
        'teamList'=>$teamList,
        'tasks' => $tasks,
        'projectId' => $projectId,
    ]) ?>

</div>
    </div>
    </div>
</div>
