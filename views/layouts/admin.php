<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\assets\CustomAsset;
use app\assets\RealAsset;
use app\models\Project;
use app\models\Tender;
use app\models\UserAssignment;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html as HelpersHtml;
use yii\helpers\Url;
use yii\jui\JuiAsset;
use yii\web\View;
use yii\web\JqueryAsset;

// CustomAsset::register($this);
// RealAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// JuiAsset::register($this->getView());
AppAsset::register($this);
JqueryAsset::register($this);
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['depends' => JqueryAsset::class]);

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

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head();
      echo Html::cssFile('@web/vendors/bootstrap/dist/css/bootstrap.min.css');
      echo Html::cssFile('@web/vendors/font-awesome/css/font-awesome.min.css');
      echo Html::cssFile('@web/vendors/nprogress/nprogress.css');
      echo Html::cssFile('@web/vendors/iCheck/skins/flat/green.css');
      echo Html::cssFile('@web/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css');
      echo Html::cssFile('@web/vendors/jqvmap/dist/jqvmap.min.css');
      echo Html::cssFile('@web/vendors/bootstrap-daterangepicker/daterangepicker.css');
      echo Html::cssFile('@web/build/css/custom.min.css');
      // echo Html::cssFile('@web/vendor/select2/dist/css/select2.min.css');
      // echo Html::cssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.3/font/bootstrap-icons.css');
      echo Html::cssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

      $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
      // $this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js');



      // echo Html::img('@web/images/favicon.png', ['alt' => 'Image'ng">


    
  $this->registerJsFile('@web/vendors/jquery/dist/jquery.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/bootstrap/dist/js/bootstrap.bundle.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/fastclick/lib/fastclick.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/nprogress/nprogress.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/Chart.js/dist/Chart.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/gauge.js/dist/gauge.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/iCheck/icheck.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/skycons/skycons.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/Flot/jquery.flot.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/Flot/jquery.flot.pie.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/Flot/jquery.flot.time.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/Flot/jquery.flot.resize.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/flot.orderbars/js/jquery.flot.orderBars.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/flot-spline/js/jquery.flot.spline.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/flot.curvedlines/curvedLines.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/DateJS/build/date.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/jqvmap/dist/jquery.vmap.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/jqvmap/dist/maps/jquery.vmap.world.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/vendors/bootstrap-daterangepicker/daterangepicker.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/build/js/custom.min.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js');
  $this->registerJsFile('@web/js/dashjs.js', ['depends' => 'yii\web\YiiAsset']);
  // $this->registerJsFile('@web/select2/dist/js/select2.min.js', ['depends' => 'yii\web\YiiAsset']);

 

    ?>


  
   
</head>
<body class="nav-md">
  <?php $this->beginBody() ?>
  <div class="container  body">
      <div class="main_container">
     
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"> <span>BPM-Tera</span></a>
            </div>


            <div class="clearfix"></div>
        

            <!-- menu proconditionfile quick info -->

            <!--
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            -->
            <!-- /menu profile quick info -->


            <br />
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  
                  <li><a><i class="fa fa-home"></i> Home<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/dashboard/admin">Dashboard</a></li>
                    </ul>
                  </li>
                 
                    <?php 
                $userId = Yii::$app->user->id;
                  // Retrieve the projects assigned to the user
                  // $newTender = Tender::find()
                  //     ->where(['session'=>0])
                  //     ->count();
                  $user_assignments = UserAssignment::find()
                  ->where(['user_id' => $userId])
                  ->all();
      
              $assignedTenderIds = [];
              foreach ($user_assignments as $user_assignment) {
                  $assignedTenderIds[] = $user_assignment->tender_id;
              }

                  $newTender=Tender::find()
                     ->where(['id' => $assignedTenderIds])
                     ->andWhere(['session'=>0])
                     ->count();
                  ?>

                  <li><a><i class="fa fa-recycle"></i>Tender<span class="badge bg-blue"><?=$newTender?></span><span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php if (Yii::$app->user->can('admin')) : ?>
                      <li><a href="/tender">index</a></li>
                      <?php endif; ?>
                     
                      <li><a href="/tender/pm">Assigned Tender</a></li>

                      <li><a href="/activity/create">Activity</a></li>
                    
                    </ul>
                  </li>
                 
                  <?php 
                  
                    $userId = Yii::$app->user->id;
                    // Retrieve the projects assigned to the user
                    $newProjects = Project::find()
                        ->where(['user_id' => $userId])
                        ->andWhere(['isViewed'=>0])
                        ->count();
                    ?>
                  <li><a><i class="fa fa-clone"></i> Project <span class="badge bg-green"><?=$newProjects?></span><span class="fa fa-chevron-down"></span> </a>
                  
                    <ul class="nav child_menu">
                    <?php if (Yii::$app->user->can('admin')) : ?>
            <li><a href="/project">index</a></li>
        <?php endif; ?>
        <?php if (Yii::$app->user->can('author')) : ?>
            <li><a href="/project/pm">Project Assigned</a>
           
          </li>
        <?php endif; ?>
                    </ul>
                  </li>
                  <?php if (Yii::$app->user->can('admin')) : ?>
                    <!--
                  <li><a><i class="fa fa-check-square"></i>Task<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/task">index</a></li>
                    </ul>
                  </li>
                  -->
              
                  <li><a><i class="fa fa-users"></i>Team<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/team">index</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                  <li><a><i class="fa fa-user"></i>User & Department<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php if (Yii::$app->user->can('admin')) : ?>
                      <li><a href="/user">index</a></li>
                      <li><a href="/role">role</a></li>
                      <li><a href="/permission">permission</a></li>
                      <li><a href="/office">office</a></li>
                      <li><a href="/department">department</a></li>
                      <?php endif; ?>
                     
                    </ul>
                  </li>
                 
                  <li><a><i class="fa fa-file-pdf-o"></i>Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">index</a></li>
                    </ul>
                  </li>
                 <!--
                  <li><a><i class="fa fa-folder-o"></i>Analysis & Requests<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/analysis">Analysis</a></li>
                      <li><a href="#">Request</a></li>
                    </ul>
                  </li>
                  -->
                 
                  <li><a><i class="fa fa-gear"></i>Settings<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">index</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            
            </div>
            </div>
        </div>
      </div>


            <!-- top navigation -->
            <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
                
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="https://cdn-icons-png.flaticon.com/128/3177/3177440.png?ga=GA1.1.812721869.1686883631" alt="profile_image">
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="profile"> Profile</a>
                      <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right"></span>
                        <span>Settings</span>
                      </a>
                  <a class="dropdown-item"  href="javascript:;">Help</a>
                    <a class="dropdown-item"  href=""><i class="fa fa-sign-out pull-right"></i>
                    <?php
   
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    
    ?>
                    
                    </a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
        <?php
        $userId = Yii::$app->user->id;
        // Retrieve the projects assigned to the user
        $newProjects = Project::find()
            ->where(['user_id' => $userId])
            ->andWhere(['isViewed' => 0])
            ->count();
        ?>
       
        <i class="fa fa-envelope-o"></i>
        <span class="badge bg-red"><?= $newProjects ?></span>
        
    </a>

    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
        <!-- Dropdown menu items go here -->
    </ul>
</li>
              </ul>

            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
        <div class="">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        
        
        </div>
        </div>
    
         <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Teratech - web application <a href="teratech.co.tz">about us</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        </div>
        </div>
    
  
        <!--begin::Body-->
  
 
   


<?php $this->endBody();

?>
</body>
</html>
<?php $this->endPage() ?>
