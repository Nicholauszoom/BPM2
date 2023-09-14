<?php

use app\models\Tender;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\i18n\Formatter;

/** @var yii\web\View $this */
/** @var app\models\TenderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tenders';
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = 'admin';

?>
<div id="main-content ">
   
   <div id="page-container">
       <!-- ============================================================== -->
       <!-- Sales Cards  -->
       <!-- ============================================================== -->
       <div class="row"></div>
<div class="tender-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tender', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PE',
            'title',
            'TenderNo',
            'budget',
            [
                'attribute' => 'publish_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // [
            //     'attribute' => 'expired_at',
            //     'format' => ['date', 'php:Y-m-d H:i:s'],
            // ],
            //////////////////////

            [
                'attribute' => 'expired_at',
                'format' => 'raw',
                'label' => 'Submitted Date',
                'value' => function ($model) {
                    $now = time();
                    $expiredDate = $model->expired_at;
                    $oneWeekAhead = strtotime('+1 week');
                    $labelClass = '';
    
                    if ($expiredDate - $now <= 0) {
                        $labelClass = 'badge badge-danger'; // Red label
                    } elseif ($expiredDate > $oneWeekAhead) {
                        $labelClass = 'badge badge-success'; // Yellow label
                    } elseif($expiredDate - $now > 0) {
                        $labelClass = 'badge badge-warning'; // Green label
                    }else{
                        $labelClass = 'badge badge-secondary';
                    }
    
                    $formatter = new Formatter();
                    $formattedDate = $formatter->asDate($model->expired_at, 'php:Y-m-d H:i:s');
                    $label = Html::tag('span', Html::encode($formattedDate), ['class' => $labelClass]);
                    return $label;
                },
            ],
    
    
    
    
            //////////////////////////


            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return getStatusLabel($model->status);
                },
                'format' => 'raw',
                'contentOptions' => function ($model) {
                    return ['class' => getStatusClass($model->status)];
                },
            ],
            // 'document',
            [
                'attribute' => 'isViewed',
                'label' => 'alert',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->isViewed ? '' : Html::tag('span', 'New', ['class' => 'badge badge-success']);
                },
            ],
            // 'status',
            //'created_at',
            //'updated_at',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tender $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            // ///////////////////
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{view} {create-project}  {update}',
            //     'buttons' => [
                    
            //         'view' => function ($url, $model, $key) {
            //             return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id], [
            //                 // 'class' => 'btn btn-success',
            //                 'title' => 'view tender',
            //                 'aria-label' => 'tender view',
            //             ]);
            //         },
    
    
            //         'update' => function ($url, $model, $key) {
            //             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], [
            //                 // 'class' => 'btn btn-success',
            //                 'title' => 'view tender',
            //                 'aria-label' => 'tender update',
            //             ]);
            //         },
            //     ],
                
            // ],
            // ///////////////
        ],
    ]); ?>
    <?php
function getStatusLabel($status)
{
    $statusLabels = [
        1 => '<span class="badge badge-success">Win</span>',
        2 => '<span class="badge badge-warning">fail</span>',
        3 => '<span class="badge badge-secondary">pending</span>',


        
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
