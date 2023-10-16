<?php

use app\models\Tattachmentss;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TattachmentssSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->context->layout = 'main';
?>
 
    <div class="templateux-cover" style="background-image: url(images/hod.jpeg);">
      <div class="container">
        <div class="row align-items-lg-center">

          <div class="col-lg-6 order-lg-1">
            <h1 class="heading mb-3 text-white" data-aos="fade-up">Bussiness Process Management <strong></strong></h1>
            <p class="lead mb-5 text-white" data-aos="fade-up"  data-aos-delay="100">A “team” is not just people who work at the same time in the same place. A real team is a group of very different individuals who enjoy working together.</p>
            <p data-aos="fade-up" data-aos-delay="200"><a href="#" class="btn btn-primary py-3 px-4 mr-3">Get Started</a> <a href="#" class="text-white">Learn More</a></p>
          </div>
          
        </div>
      </div>
    </div> <!-- .templateux-cover -->

    <div class="templateux-section pt-0 pb-0">
      <div class="container">
        <div class="row">
          <div class="col-md-12 templateux-overlap">
            <div class="row">
              <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="media block-icon-1 d-block text-left">
                  <div class="icon mb-3">
                    <img src="/images/flaticon/svg/001-consultation.svg" alt="Image" class="img-fluid">
                  </div>
                  <div class="media-body">
                    <h3 class="h5 mb-4">Tender</h3>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <p><a href="#">Learn More</a></p>
                  </div>
                </div> <!-- .block-icon-1 -->
              </div>
              <div class="col-md-4" data-aos="fade-up" data-aos-delay="700">
                <div class="media block-icon-1 d-block text-left">
                  <div class="icon mb-3">
                    <img src="images/flaticon/svg/002-discussion.svg" alt="Image" class="img-fluid">
                  </div>
                  <div class="media-body">
                    <h3 class="h5 mb-4">Project</h3>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <p><a href="#">Learn More</a></p>
                  </div>
                </div> <!-- .block-icon-1 -->
              </div>
              <div class="col-md-4" data-aos="fade-up" data-aos-delay="800">
                <div class="media block-icon-1 d-block text-left">
                  <div class="icon mb-3">
                    <img src="images/flaticon/svg/003-turnover.svg" alt="Image" class="img-fluid">
                  </div>
                  <div class="media-body">
                    <h3 class="h5 mb-4">Operation</h3>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <p><a href="#">Learn More</a></p>
                  </div>
                </div> <!-- .block-icon-1 -->
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .templateux-section -->

  </div> <!-- .templateux-section -->

  
  <div class="templateux-section bg-light">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12 text-center mb-5">
          <h2>BPM Coverage</h2>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="images/flaticon/svg/004-gear.svg" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Project Management</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="images/flaticon/svg/005-conflict.svg" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Human Resourse Management</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="images/flaticon/svg/006-meeting.svg" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Operation Management</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="images/flaticon/svg/007-brainstorming.svg" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Inventory Management</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="images/flaticon/svg/001-consultation.svg" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Intuitive Thinking</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="images/flaticon/svg/009-brainstorming-2.svg" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Play Video</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>

      </div>
    
    </div>
  </div> <!-- .templateux-section -->

</div> <!-- .templateux-section -->



