<?php

use app\models\Project;
use app\models\Tender;
use yii\helpers\Html;
use yii\bootstrap5\Modal;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Analysis $model */

$this->title = 'Create Analysis';
$this->params['breadcrumbs'][] = ['label' => 'Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = 'admin';


$project = Project::findOne($projectId);
$project_tender = $project ? $project->tender_id : '';
$project_tender_id=Tender::findOne($project_tender);
$projectName = $project_tender_id ? $project_tender_id->title : '';
$this->title = 'Create Analysis for :' . $projectName . ' Project';


?>
<a href="<?= Yii::$app->request->referrer ?>" class="back-arrow">
    <span class="arrow">&#8592;</span> Back
</a>
<div class="analysis-create">
<center> 
    <hr/><img src='/images/teralog.png' style="width: 60px;">
    <h2 style="color:blue;">TERA TECHNOLOGIES  AND ENGINEERING LIMITED</h2>
    <hr/>
  <p><span style="color:brown;">REGISTERED CONTRACTOR IN ELECTRICAL</span><span style="color:blue;"> (CLASS TWO) ___</span><span style="color:brown;">TELECOMMS, ICT AND SECURITY SYSTEMS</span> <span style="color:blue;">(CLASS ONE)__</span><span style="color:brown;">HVAC</span><span style="color:blue;"> (CLASS TWO)</span></p>
    <hr/>
    <p>Office: Mbezi Beach Africana, Plot No. 2283, Block H, Tarangire Street, Bagamoyo Road/Africana Drive, P.O. Box 31257, Dar es Salaam, Tanzania  Tel/Fax: +255 22 2701611, Cell: +255 713 899 309, +255 767 598691 : Email: <span style="color:blue;">info@teratech.co.tz </span>, Website: <span style="color:blue;">www.teratech.co.tz</span></p>
    <hr/></center>

<center><h1 style=" color:lightseagreen;"><?= Html::encode($this->title) ?></h1></center>

    <?= $this->render('_form', [
        'model' => $model,
        'details' => $details,
        'projectId' => $projectId,
        'projectAmount'=>$projectAmount,
        'profit' => $profit,
        'profitPerce'=> $profitPerce,
        'u_amount'=> $u_amount,
        'unit_profit'=> $unit_profit
    ]) ?>





</div>


