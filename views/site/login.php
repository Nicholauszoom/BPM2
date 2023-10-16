<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->context->layout = 'main2';
?>


<section class="vh-100" style="background-color: white;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

              

                  <?php $form = ActiveForm::begin(['id' => 'login-form',
                'options'=>['class'=>'user']
            ]); ?>
                <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0 "><img src="http://teratech.co.tz/local/images/uploads/logo/163277576061522e507c527.webp" style="height: 60px;" />
</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                  <div class="form-outline mb-4">
<?= $form->field($model, 'email')->textInput(['autofocus' => true,    'template' => "<div class=\"form-control form-control-lg\">{input} {label}</div>\n<div class=\"form-label\">{error}</div>",
]) ?>
</div>
<div class="form-outline mb-4">
<?= $form->field($model, 'password')->passwordInput([    'template' => "<div class=\"form-control form-control-lg\">{input} {label}</div>\n<div class=\"form-label\">{error}</div>",
]) ?>
</div>
 <div class="form-outline mb-4">
<?= $form->field($model, 'rememberMe')->checkbox([
    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"form-label\">{error}</div>",
]) ?>
</div>
              
                <div class="pt-1 mb-4">
            <?= Html::submitButton('Login', ['class' => 'btn btn-dark btn-lg btn-block', 'name' => 'login-button']) ?>
            </div>
           

            <?php ActiveForm::end() ?>

            <a class="small text-muted" href="<?php echo \yii\helpers\Url::to(['/site/forgot-password']) ?>">Forgot Password?</a>
        </br>
            <a class="small text-muted" href="<?php echo \yii\helpers\Url::to(['/']) ?>">back home</a>

        
                
               
          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>