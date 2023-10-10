<?php

use yii\helpers\Html;
?>
<p>Hello <?= $user->username ?>,</p>
<p>Click the following link to reset your password:</p>
<p><?= Html::a('Reset Password', ['site/reset-password', 'token' => $user->access_token], ['target' => '_blank']) ?></p>
<p>If you did not request a password reset, please ignore this email.</p>