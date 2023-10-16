<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\View;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  
    <link rel="stylesheet" href="css/style2.css">

</head>
<body>
<?php $this->beginBody() ?>
<div class="js-animsition animsition" id="site-wrap" data-animsition-in-class="fade-in" data-animsition-out-class="fade-out">


<header class="templateux-navbar" role="banner">

  <div class="container"  data-aos="fade-down">
    <div class="row">

      <div class="col-3 templateux-logo">
        <a href="/" class="animsition-link">BPM-Tera</a>
      </div>
      <nav class="col-9 site-nav">
        <button class="d-block d-md-none hamburger hamburger--spin templateux-toggle templateux-toggle-light ml-auto templateux-toggle-menu" data-toggle="collapse" data-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button> <!-- .templateux-toggle -->

        <ul class="sf-menu templateux-menu d-none d-md-block">
          <li class="active">
            <a href="/" class="animsition-link">Home</a>
          </li>
          <li><a href="site/login" class="animsition-link">Sign in</a></li>
          <li>
            <a href="" class="animsition-link">Services</a>
            <ul>
              <li><a href="#">HR Consulting</a></li>
              <li><a href="#">Leadership Training</a></li>
              <li>
                <a href="#">HR Management</a>
                <ul>
                  <li><a href="#">Operational Management</a></li>
                  <li><a href="#">Corporate Program</a></li>
                  <li>
                    <a href="#">Service 3</a>
                    <ul>
                      <li><a href="#">Service 1</a></li>
                      <li><a href="#">Service 2</a></li>
                      <li><a href="#">Service 3</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="" class="animsition-link">Blog</a></li>
          <li><a href="" class="animsition-link">Contact</a></li>
        </ul> <!-- .templateux-menu -->

      </nav> <!-- .site-nav -->
      

    </div> <!-- .row -->
  </div> <!-- .container -->
</header> <!-- .templateux-navba -->

        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
  

<footer class="templateux-footer bg-light">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-4 pr-md-5">
        <div class="block-footer-widget">
          <h3>About</h3>
          <p>Bussiness Processes Management .</p>
        </div>
      </div>

      <div class="col-md-8">
        <div class="row">
          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>Learn More</h3>
              <ul class="list-unstyled">
                <li><a href="#">How it works?</a></li>
                <li><a href="#">Useful Tools</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Sitemap</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>Support</h3>
              <ul class="list-unstyled">
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Help Desk</a></li>
                <li><a href="#">Knowledgebase</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>About Us</h3>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>Connect With Us</h3>
              <ul class="list-unstyled block-social">
                <li><a href="#" class="p-1"><span class="icon-facebook"></span></a></li>
                <li><a href="#" class="p-1"><span class="icon-twitter"></span></a></li>
                <li><a href="#" class="p-1"><span class="icon-github"></span></a></li>
              </ul>
            </div>
          </div>
        </div> <!-- .row -->

      </div>
    </div> <!-- .row -->

    <div class="row pt-5 text-center">
      <div class="col-md-12 text-center"><p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This application is made with  <a href="" target="_blank" class="text-primary">teratech</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p></div>
    </div> <!-- .row -->

  </div>
</footer> <!-- .templateux-footer -->


</div> <!-- .js-animsition -->


<script src="/js/scripts-all.js"></script>
<script src="/js/main.js"></script>

</body>
</html>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>