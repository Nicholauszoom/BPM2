<?php

namespace app\models;

use yii\base\Model;
use app\models\User;

class ResetPasswordForm extends Model
{
    public $password;
    public $token;

    public function rules()
    {
        return [
            [['password', 'token'], 'required'],
            [['password'], 'string', 'min' => 6],
        ];
    }
}