<?php

namespace app\controllers;

use app\models\Analysis;
use app\models\Project;
use app\models\Task;
use app\models\Team;
use app\models\Tender;
use app\models\User;
use app\models\UserAssignment;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use Yii;
use dosamigos\chartjs\ChartJs;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class DashboardController extends \yii\web\Controller
{
    public function actionAdmin()
    {

        //count project by user_id
        $userId = Yii::$app->user->id;
        $projectCount = Project::find()
            ->where(['user_id' => $userId])
            ->all();
     
// Calculate the assigned project budget for given project manager
$projectBudget = array_sum( $projectCount);


        // Query the project table to fetch the budget values
$budgets = Project::find()->select('budget')->column();

// Calculate the total budget
$totalBudget = array_sum($budgets);
//TOTAL BUDGET  PER PROJECT IN YEAR
$data = Project::find()
    ->select([new \yii\db\Expression('EXTRACT(YEAR FROM created_at) AS year'), 'SUM(budget) AS total_budget'])
    ->groupBy(['EXTRACT(YEAR FROM created_at)'])
    ->asArray()
    ->all();

    $formattedData = [];
    foreach ($data as $item) {
        $formattedData[] = [
            'year' => (int)$item['year'],
            'total_budget' => (float)$item['total_budget'],
        ];
    }

    $chartDataSS = Json::encode($formattedData);



        //TOTAL SUCCESS TASK PER M | YEAR
        //retrieve the monthly and yearly success project counts from the database
    $monthlyCounts = Project::find()
    ->select(['MONTH(created_at) AS month', 'COUNT(*) AS count'])
    ->where(['status' => 1])
    ->groupBy(['month'])
    ->asArray()
    ->all();

$yearlyCounts = Project::find()
    ->select(['YEAR(created_at) AS year', 'COUNT(*) AS count'])
    ->where(['status' => 1])
    ->groupBy(['year'])
    ->asArray()
    ->all();

$chartData = [
    'labels' => [],
    'data' => [],
];

// Prepare the data for the chart
foreach ($monthlyCounts as $count) {
    $chartData['labels'][] = date('F', mktime(0, 0, 0, $count['month'], 1)); // Format the month name
    $chartData['data'][] = (int)$count['count'];
}

// Prepare the data for the yearly chart
foreach ($yearlyCounts as $count) {
    $chartData['labels'][] = $count['year'];
    $chartData['data'][] = (int)$count['count'];
}
      
//TOTAL FAIL TASK PER M | YEAR


    // Retrieve the monthly and yearly project counts with statuses other than 1 from the database
    $monthlyCounts = Project::find()
        ->select(['MONTH(created_at) AS month', 'COUNT(*) AS count'])
        //->where(['NOT', ['status' => 1]]) // Exclude projects with status 1
        ->where(['status' => 2])
        ->groupBy(['month'])
        ->asArray()
        ->all();

    $yearlyCounts = Project::find()
        ->select(['YEAR(created_at) AS year', 'COUNT(*) AS count'])
        // ->where(['NOT', ['status' => 1]]) // Exclude projects with status 1
        ->where(['status' => 2])
        ->groupBy(['year'])
        ->asArray()
        ->all();

    $chartDatas = [
        'labels' => [],
        'data' => [],
    ];

    // Prepare the data for the chart
    foreach ($monthlyCounts as $count) {
        $chartDatas['labels'][] = date('F', mktime(0, 0, 0, $count['month'], 1)); // Format the month name
        $chartDatas['data'][] = (int)$count['count'];
    }

    // Prepare the data for the yearly chart
    foreach ($yearlyCounts as $count) {
        $chartDatas['labels'][] = $count['year'];
        $chartDatas['data'][] = (int)$count['count'];
    }




    $info = Tender::find()
    ->select([
        'DATE_FORMAT(created_at, "%M, %Y") AS month_year',
        'status',
        'COUNT(*) AS count'
    ])
    ->where(['status' => [1, 2]]) // Include status 1 and 2
    ->groupBy(['month_year', 'status'])
    ->asArray()
    ->all();

$months = [];
$datasets = [];
foreach ($info as $item) {
    $monthYear = $item['month_year'];
    $status = 'Status ' . $item['status'];

    // Check if dataset exists for the status
    $datasetIndex = array_search($status, array_column($datasets, 'label'));
    if ($datasetIndex === false) {
        $datasets[] = [
            'label' => $status,
            'backgroundColor' => $item['status'] == 1 ? 'rgba(0, 255, 0, 0.5)' : 'rgba(255, 0, 0, 0.5)', // Green color for Status 1, Red color for Status 2
            'borderColor' => $item['status'] == 1 ? 'rgba(0, 255, 0, 1)' : 'rgba(255, 0, 0, 1)',
            'borderWidth' => 1,
            'data' => [(int)$item['count']]
        ];
    } else {
        $datasets[$datasetIndex]['data'][] = (int)$item['count'];
    }

    if (!in_array($monthYear, $months)) {
        $months[] = $monthYear;
    }
}

$chartData = [
    'labels' => $months,
    'datasets' => $datasets,
];

$options = [
    'responsive' => true,
    'maintainAspectRatio' => false,
    'scales' => [
        'yAxes' => [
            [
                'ticks' => [
                    'beginAtZero' => true,
                    'fontColor' => '#333', // Customize font color
                    'fontSize' => 12, // Customize font size
                    'stepSize' => 1, // Customize step size
                ],
                'gridLines' => [
                    'color' => '#ddd', // Customize grid line color
                    'zeroLineColor' => '#ddd', // Customize zero line color
                ],
            ],
        ],
        'xAxes' => [
            [
                'ticks' => [
                    'fontColor' => '#333', // Customize font color
                    'fontSize' => 12, // Customize font size
                ],
                'gridLines' => [
                    'color' => '#ddd', // Customize grid line color
                ],
            ],
        ],
    ],
    'legend' => [
        'labels' => [
            'fontColor' => '#333', // Customize legend font color
            'fontSize' => 12, // Customize legend font size
        ],
    ],
];


//GRAPH FOR TENDER SUMMARIZATION
$info = Tender::find()
->select([
    'MONTH(created_at) AS month',
    'status',
    'COUNT(*) AS count'
])
->where(['status' => [1, 2]]) // Include status 1 and 2
->groupBy(['MONTH(created_at)', 'status'])
->asArray()
->all();

$months = [];
$datasets = [];
foreach ($info as $item) {
$month = date('F', mktime(0, 0, 0, $item['month'], 1));
$status = 'Status ' . $item['status'];

// Check if dataset exists for the status
$datasetIndex = array_search($status, array_column($datasets, 'label'));
if ($datasetIndex === false) {
    $datasets[] = [
        'label' => $status,
        'backgroundColor' => $item['status'] == 1 ? 'rgba(255, 0, 0, 0.5)' : 'rgba(0, 255, 0, 0.5)', // Green color for status 1, Red color for status 2
        'borderColor' => $item['status'] == 1 ? 'rgba(0, 255, 0, 1)' : 'rgba(255, 0, 0, 1)',
        'borderWidth' => 1,
        'data' => [(int)$item['count']]
    ];
} else {
    $datasets[$datasetIndex]['data'][] = (int)$item['count'];
}

if (!in_array($month, $months)) {
    $months[] = $month;
}
}

$chartData = [
'labels' => $months,
'datasets' => $datasets,
];

$options = [
    'responsive' => true,
    'maintainAspectRatio' => false,
    'scales' => [
        'yAxes' => [
            [
                'ticks' => [
                    'beginAtZero' => true,
                    'fontColor' => '#333', // Customize font color
                    'fontSize' => 12, // Customize font size
                    'stepSize' => 1, // Customize step size
                ],
                'gridLines' => [
                    'color' => '#ddd', // Customize grid line color
                    'zeroLineColor' => '#ddd', // Customize zero line color
                ],
            ],
        ],
        'xAxes' => [
            [
                'ticks' => [
                    'fontColor' => '#333', // Customize font color
                    'fontSize' => 12, // Customize font size
                ],
                'gridLines' => [
                    'color' => '#ddd', // Customize grid line color
                ],
            ],
        ],
    ],
    'legend' => [
        'labels' => [
            'fontColor' => '#333', // Customize legend font color
            'fontSize' => 12, // Customize legend font size
        ],
    ],
];
      //cont...   /////

      //GRAPH PLOT OF THE PROJECT AGAINST BUDGET
    

      $projects = Project::find()->all();
      

      $projectNames = [];
      $budgetData = [];
  
      foreach ($projects as $project) {
        $tender_det=Tender::findOne($project->tender_id);

        if ($tender_det === null) {
            continue;
        }

          $projectNames[] = $tender_det->title;
          $analysis_proj_cost = Analysis::find()
          ->where(['project' => $project->id])
          ->sum('cost');

          $proj_prof=$project->budget - $analysis_proj_cost;
          $budgetData[] = $proj_prof;
      }
  
// Calculate the total budget
$totalBudget = array_sum($budgets);

$tendersPerDay = Tender::find()
->select(["FROM_UNIXTIME(created_at, '%Y-%m-%d') AS date", 'COUNT(*) AS count'])
->groupBy(['date'])
->asArray()
->all();

// Prepare the data for the graph
$dates = [];
$counts = [];

foreach ($tendersPerDay as $tender) {
$dates[] = $tender['date'];
$counts[] = $tender['count'];
}


// Retrieve the data from the database or any other source


    // project and tender summary for a apecific user
      //get logged in user id
      $userId= Yii::$app->user->id;

      //get login user account profile
      $profile = User::findOne($userId);

      //get tender for specific user
      $tender_user=UserAssignment::find()
      ->where(['user_id'=>$userId])
      ->all();


      $tender_summary = [];
      foreach ($tender_user as $tendr) {
          $tender_summary =Tender::find()
          ->where(['id'=>$tendr->tender_id])
          ->all();
      }

      //get project for specific user
      $projectsum=Project::find()
      ->where(['user_id'=>$userId])
      ->all();



        
        $tenderPend=Tender::find()->where(['status'=>3])->count();
        $tenderFail=Tender::find()->where(['status'=>2])->count();
        $tenderWin=Tender::find()->where(['status'=>1])->count();
        $tender=Tender::find()->count();
        $team= Team::find()->count();
        $total= Project::find()->count();
        $task= Task::find()->count();
        $successCount = Project::find()->where(['status' => 1])->count();
        $failCount = Project::find()->where(['status' => 2])->count();
        return $this->render('admin', [
            'successCount' => $successCount,
            'total' => $total,
            'fail' => $failCount,
            'task' => $task,
            'team'=>$team,
            'chartData' => $chartData,// this is for project successs
            'chartDatas' => $chartDatas, //this is for  project fail
            'totalBudget'=>$totalBudget, //TOTAL BUDGET
            'data' => $chartDataSS ,// DATA FOR LINE CHART FOR BUDGET PER YEAR
            'projectCount '=> $projectCount ,//count all projects assigned to a project manager
            'projectBudget'=>$projectBudget,
           
            // 'dataProvider' => $dataProvider,
            'tender'=>$tender,//count total tender
            'tenderWin'=>$tenderWin,//count tender win
            'tenderFail'=>$tenderFail,//count tender fail
            'tenderPend'=>$tenderPend,//count tender pending
            'chartData'=>$chartData,
            'options'=>$options,
            'projectNames' => $projectNames,//graph data for project name
            'budgetData' => $budgetData,//graph data for project name

            'dates' => $dates,// for Tender per day graph
        'counts' => $counts, //for Tender per day graph

        'tender_summary'=>$tender_summary,
        'profile'=>$profile,
        'projectsum'=>$projectsum,
        
        ]);
    }



    public function actionProfile(){

        //get logged in user id
        $userId= Yii::$app->user->id;

        //get login user account profile
        $profile = User::findOne($userId);

        //get tender for specific user
        $tender_user=UserAssignment::find()
        ->where(['user_id'=>$userId])
        ->all();


        $tender = [];
        foreach ($tender_user as $tendr) {
            $tender =Tender::find()
            ->where(['id'=>$tendr->tender_id])
            ->all();
        }

        //get project for specific user
        $project=Project::find()
        ->where(['user_id'=>$userId])
        ->all();


        return $this->render('profile',[
            'profile'=>$profile,
            'tender'=>$tender,
            'project'=>$project
            
        ]);
    }


}
