<?php
    // Get the current route URL
use dosamigos\chartjs\ChartJs;
use app\models\Department;
use yii\helpers\Url;
use app\models\Project;
use app\models\Tender;
use yii\helpers\Json;
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
        $tender = Tender::find()
            ->where(['assigned_to' => $userId])
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
        <div>
          <h2 class="text-muted mt-10 text-center">A Graph Of Project Against Profit</h2>
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="chart-container">
                <canvas id="lineChart" style="width: 100%; height: 400px;"></canvas>
              </div>
            </div>
          </div>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              var projectNames = <?= $projectNamesJson ?>;
              var budgetData = <?= $budgetDataJson ?>;

              var ctx = document.getElementById('lineChart').getContext('2d');
              new Chart(ctx, {
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
            });
          </script>
        </div>

        <h2 class="text-muted mt-20 text-center">A Graph Of Tender Status Against Time</h2>
        <div class="col-md-8 offset-md-2 bg-white mt-20">
          <div class="chart-container" style="margin-top: 20px;">
            <canvas id="tenderChart" style="width: 100%; height: 400px;"></canvas>
          </div>

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              var chartData = <?= json_encode($chartData) ?>;
              var options = <?= json_encode($options) ?>;

              var ctx = document.getElementById('tenderChart').getContext('2d');
              new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: options
              });
            });
          </script>
        </div>
      <?php endif; ?>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
       


     
           


             
                

 