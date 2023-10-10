<?php

namespace app\models;

use yii\base\Model;

class ForgotPasswordForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }
}