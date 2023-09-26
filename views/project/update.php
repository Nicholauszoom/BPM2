<?php

use app\models\Project;
use app\models\Tender;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Project $model */

$project = Project::findOne($id);
$project_tender = $project ? $project->tender_id : '';
$project_tender_id=Tender::findOne($project_tender);
$projectName = $project_tender_id ? $project_tender_id->title : '';
$this->title = 'View for :' . $projectName . ' Project';

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $projectName , 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->context->layout = 'admin';

?>

<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>

    <div id="page-container">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row">
<div class="project-update">

    

    <?= $this->render('_form', [
        'model' => $model,
        'users'=>$users,
        'id'=>$id,
        'details'=>$details,
        
     
    ]) ?>

</div>
        </div>
    </div>
</div>
