<?php
    // Get the current route URL
use dosamigos\chartjs\ChartJs;
use app\models\Department;
use yii\helpers\Url;
use app\models\Project;
use app\models\Tender;
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
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                   
                  

                  </div>
                  <div class="col-md-6">
                   
                  </div>
                </div>
                <?php if (Yii::$app->user->can('admin')) : ?>
                  <div class="col-md-9 col-sm-9 ">

<div class="chart-container">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<center><h1>Tender Chart</h1></center>


<div class="chart-container">
  <center><canvas id="tenderChart" ></canvas></center>
</div>


<script>
    var ctx = document.getElementById('tenderChart').getContext('2d');
    
    var chartData = {
        labels: <?= json_encode($chartData['labels']) ?>,
        datasets: [
            {
                label: '  win',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: ' rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: <?= json_encode($chartData['datasets'][0]['data']) ?>
            },
            {
                label: 'lose',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)' ,
                borderWidth: 1,
                data: <?= json_encode($chartData['datasets'][1]['data']) ?>
            }
        ]
    };
    
    var chartOptions = <?= json_encode($options) ?>;
    
    var tenderChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: chartOptions
    });
</script>
</div>
                </div>
              

              
                <div class="col-md-3 col-sm-3  bg-white">
                  <div class="x_title">

<!-- Include the Chart.js library -->


                  </div>

                
                </div>
               
  
<?php endif; ?>





                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

       


     
           


             
                

 