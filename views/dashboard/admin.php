<?php
    // Get the current route URL
use dosamigos\chartjs\ChartJs;
use app\models\Department;
use yii\helpers\Url;
use app\models\Project;
use app\models\Tender;
use app\models\UserAssignment;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

   // Get the current route URL
$currentUrl = Url::toRoute(Yii::$app->controller->getRoute());

// Define an array of sidebar items with their URLs and labels
$sidebarItems = [
    ['url' => ['/dashboard/admin'], 'label' => 'Home', 'icon' => 'bi bi-house'],
    ['url' => ['/project'], 'label' => 'Projects', 'icon' => 'bi bi-layers'],
    ['url' => ['/task'], 'label' => 'Task', 'icon' => 'bi bi-check2-square'],
    ['url' => ['/team'], 'label' => 'Team', 'icon' => 'bi bi-people'],
    ['url' => ['/member'], 'label' => 'Member', 'icon' => 'bi bi-person'],
    ['url' => ['/report'], 'label' => 'Report', 'icon' => 'bi bi-file-text'],
    ['url' => ['/setting'], 'label' => 'Settings', 'icon' => 'bi bi-gear'],
];
/** @var yii\web\View $this */

$this->title = 'My Yii Application';

$this->context->layout = 'admin'; 

//PROJECT CONVERSION DATA FROM ARRAY TO STRING

$projectNamesJson = Json::encode($projectNames);
$budgetDataJson = Json::encode($budgetData);

?>



   <!-- top tiles -->

<div class="row justify-content-center">
  <!-- PROJECT MANAGEMENT SUMMARY-->
  <div class="tile_count">

  <!-- /admin dash  -->
  <?php if (Yii::$app->user->can('admin')) : ?>
          
        
    <div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-bullhorn"></i> Announced Tender</span>
      <div class="count"><?= $tender ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> </span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-check-square"></i>Tender Win</span>
      <div class="count "><?= $tenderWin ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i></span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
    <?php
        
        $projectHolds = Project::find()
            ->Where(['status' => 3])
            ->count();
            
        ?>
      <span class="count_top"><i class="fa fa-circle-o-notch"></i>Tender Pending..</span>
      <div class="count "><?= $tenderPend?></div>
      <span class="count_bottom"><i class="orange"><i class="fa fa-sort-desc"></i></i> </span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-minus-circle"></i> Tender Lose</span>
      <div class="count "><?= $tenderFail?></div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i></i> </span>
    </div>

     <!-- <div class="col-md-2 col-sm-4 tile_stats_count">
        <?php
          $department = Department::find()
          ->count();
        ?>
      <span class="count_top"><i class="fa fa-users"></i> Departments </span>
      <div class="count "><?=$department?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> </span>
    </div> 

    <div class="col-md-2 col-sm-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-money"></i>Total Projects Budget</span>
  <div class="">
    TSH <?=$totalBudget ?>
  </div>
  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i></span>
</div>-->
<?php endif; ?>
<!-- /admin dash end -->

<!-- /Project Manager Dashboard -->

<!-- /pm end -->
  </div>


  <!-- TENDER MANAGEMENT SUMMARY-->
  <div class="tile_count">

  <!-- /admin dash  -->
  <?php if (Yii::$app->user->can('admin')) : ?>
          
        
    <div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-folder"></i> Total Projects</span>
      <div class="count"><?= $total ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> </span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-check"></i> Complete Projects</span>
      <div class="count "><?= $successCount ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i></span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
    <?php
        
        $projectHolds = Project::find()
            ->Where(['status' => 3])
            ->count();
            
        ?>
      <span class="count_top"><i class="fa fa-clone"></i> OnHold Projects</span>
      <div class="count "><?= $projectHolds?></div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i></i> </span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-close"></i> Fail Projects</span>
      <div class="count "><?= $fail?></div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i></i> </span>
    </div>

      <div class="col-md-2 col-sm-4 tile_stats_count">
        <?php
          $department = Department::find()
          ->count();
        ?>
      <span class="count_top"><i class="fa fa-users"></i> Departments </span>
      <div class="count "><?=$department?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> </span>
    </div> 

    <div class="col-md-2 col-sm-6 tile_stats_count">
  <span class="count_top"><i class="fa fa-money"></i>Total Projects Budget</span>
  <div class="">
    TSH <?=$totalBudget ?>
  </div>
  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i></span>
</div>
<?php endif; ?>
<!-- /admin dash end -->

<!-- /Project Manager Dashboard -->
<?php if (Yii::$app->user->can('author')) : ?>

  <div class="col-md-2 col-sm-4 tile_stats_count">
    <?php
        $userId = Yii::$app->user->getId();

        $user_assignments = UserAssignment::find()
        ->where(['user_id' => $userId])
        ->all();

    $assignedTenderIds = [];
    foreach ($user_assignments as $user_assignment) {
        $assignedTenderIds[] = $user_assignment->tender_id;
    }

        $tender=Tender::find()
           ->where(['id' => $assignedTenderIds])
           ->andWhere(['session'=>0])
           ->count();
        ?>
        
      <span class="count_top"><i class="fa fa-folder"></i> Assigned Tender</span>
      <div class="count"><?= $tender ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> </span>
    </div>
      
<div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-clone"></i> Assigned Project</span>
      <?php
        $userId = Yii::$app->user->getId();
        $projectCount = Project::find()
            ->where(['user_id' => $userId])
            ->count();
        ?>
        <div class="count"><?= $projectCount ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> </span>
    </div>


    <div class="col-md-2 col-sm-4 tile_stats_count">
    <?php
        $userId = Yii::$app->user->getId();
        $projectSuccess = Project::find()
            ->where(['user_id' => $userId])
            ->andWhere(['status' => 1])
            ->count();
        ?>
      <span class="count_top"><i class="fa fa-check"></i> Complete Project</span>
      <div class="count "><?=$projectSuccess?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i></span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
    <?php
        $userId = Yii::$app->user->getId();
        $projectHold = Project::find()
            ->where(['user_id' => $userId])
            ->andWhere(['status' => 3])
            ->count();
        ?>
      <span class="count_top"><i class="fa fa-check"></i> Projects OnHold</span>
      <div class="count "><?=$projectHold?></div>
      <span class="count_bottom"><i class="warning" style="color:yellow"> <i class="fa fa-sort-asc"></i></i></span>
    </div>

    <div class="col-md-2 col-sm-4 tile_stats_count">
    <?php
$userId = Yii::$app->user->getId();

// Count failed projects for the logged-in user
$projectFail = Project::find()
    ->where(['user_id' => $userId])
    ->andWhere(['status' => 2])
    ->count();
?>
      <span class="count_top"><i class="fa fa-close"></i> Fail Project</span>
      <div class="count "><?=$projectFail?></div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i></i> </span>
    </div>


    <div class="col-md-2 col-sm-6 tile_stats_count">

    <?php
$userId = Yii::$app->user->getId();

// Find projects assigned to the user
$projects = Project::find()
    ->where(['user_id' => $userId])
    ->all();

// Calculate the total project budget for the assigned projects
$projectBudget = 0;
foreach ($projects as $project) {
    $projectBudget += $project->budget;
}
$formattedBudget = number_format($projectBudget, 2)
?>
  <span class="count_top"><i class="fa fa-money"></i>Projects Budget</span>
  <div class="">
  <?= $formattedBudget ?>
  </div>
  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i></span>
</div>
<?php endif; ?>
<!-- /pm end -->
  </div>
</div>
          <!-- /top tiles -->
       
           
          <div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="dashboard_graph">
      <div class="row x_title">
        <div class="col-md-6">
        </div>
      </div>
      <?php if (Yii::$app->user->can('admin')) : ?>
    <!-- Include the latest version of Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h2 class="text-muted mt-10 text-center">A Graph Of Project Against Profit</h2>
      <div class="chart-container">
        <canvas id="lineChart" style="width: 100%; height: 400px;"></canvas>
      </div>
    </div>
  </div>

  <div class="row mt-30">
    <div class="col-md-8 offset-md-2">
      <h2 class="text-muted mt-20 text-center">A Graph of Tender per Day</h2>
      <div class="chart-container">
        <canvas id="myChart" style="width: 100%; height: 400px;"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
  // Retrieve the data from the PHP controller
  var projectNames = <?= $projectNamesJson ?>;
  var budgetData = <?= $budgetDataJson ?>;
  var dates = <?= json_encode($dates) ?>;
  var counts = <?= json_encode($counts) ?>;

  // Create the line chart
  var ctxLine = document.getElementById('lineChart').getContext('2d');
  new Chart(ctxLine, {
    type: 'line',
    data: {
      labels: projectNames,
      datasets: [{
        label: 'Profit',
        data: budgetData,
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderWidth: 1,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1000,
          },
        },
      },
    }
  });

  // Create the bar chart
  var ctxBar = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: dates,
      datasets: [{
        label: 'Tenders per Day',
        data: counts,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          }
        },
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });

  // Add custom animations using jQuery
  $(document).ready(function() {
    // Animate the line chart on page load
    $(".row:first-child .chart-container").hide().fadeIn(1500);

    // Apply additional styling to the line chart container
    $(".row:first-child .chart-container").css({
      'border-radius': '10px',
      'box-shadow': '0 4px 6px rgba(0, 0, 0, 0.1)'
    });

    // Animate the bar chart on page load
    $(".row:last-child .chart-container").hide().fadeIn(1500);

    // Apply additional styling to the bar chart container
    $(".row:last-child .chart-container").css({
      'border-radius': '10px',
      'box-shadow': '0 4px 6px rgba(0, 0, 0, 0.1)'
    });
  });
</script>
<?php endif; ?>
      <div class="clearfix"></div>
    </div>
  </div>
</div>


<div>

<!-- Include Chart.js library -->

<!-- Create the canvas element -->

        </div>
       


     
           


             
                

 