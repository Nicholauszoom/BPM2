<?php

/** @var \yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <style>

html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
.bg-login-image {
  background: url("http://teratech.co.tz/local/images/uploads/logo/163277576061522e507c527.webp");
  background-position: center;
  background: 500;
  background-repeat: no-repeat;
}
    </style>
</head>
<body id="page-top" >
<?php $this->beginBody() ?>
<!-- Page Wrapper -->
<header id="header">
    
</header>
<main id="main" class="flex-shrink-0" role="main" style="padding: 105px; " >

           <div class="m-40">

            <!-- Begin Page Content -->

            <!-- /.container-fluid -->
           <div class="p-3">
               <?php echo $content ?>
           </div>

        
        </div>
</main>
        <!-- End of Main Content -->

        <!-- Footer -->
    
<!-- End of Page Wrapper -->


<!-- Logout Modal-->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this -> endPage()?>

