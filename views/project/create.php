<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Project $model */

$this->title = 'Create Project';

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;

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
       
<div class="project-create">


    <?= $this->render('_form', [
        'model' => $model,
        'users'=>$users,
        'details'=>$details,
        
    ]) ?>

</div>
        </div>
    </div>

</div>

