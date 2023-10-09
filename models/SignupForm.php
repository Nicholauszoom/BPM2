<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\rbac\Rule;
use app\models\AuthAssignment;
use yii\validators\EmailValidator;

class SignupForm extends Model
{
public $username;

public $email;
public $password;
public $password_repeat;

public $permissions;

public $department;


public function rules(){
    return [
        [['username','password','password_repeat','email', 'department'], 'required'],
        [['username','password','password_repeat','email'],'string','min'=>4,'max'=>40],
        ['password_repeat','compare','compareAttribute'=>'password'],
        ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email has already been taken.'],
        ['email', 'string', 'max' => 40, 'tooLong' => 'Email should contain at most 16 characters.'],
        ];
}


public function signup()
{
    if ($this->validate()) {
        $user = new User();
    $user ->username= $this->username;

    $user ->department = $this->department;
    $user ->email =$this->email;
    $user ->password = \Yii::$app->security->generatePasswordHash($this->password);
    $user ->access_token =\Yii::$app->security->generateRandomString();
    $user ->auth_key =\Yii::$app->security->generateRandomString();
    $user->save(false);

        // the following three lines were added:
        
// $auth = Yii::$app->authManager;
// $adminRole = $auth->getRole('author');
// $auth->assign($adminRole, $user->id);

        
        

        // let add the permissions
        $permissionList = $_POST['SignupForm']['permissions'];
        foreach ($permissionList as $value)
        {
        $newPermission = new AuthAssignment;
        $newPermission -> user_id= $user->id;
        $newPermission -> item_name = $value;
        $newPermission ->save();
        }
        return $user;
    }

    return null;
}

// public function signUp(){
//     $user = new User();
//     $user ->username= $this->username;
//     $user ->password = \Yii::$app->security->generatePasswordHash($this->password);
//     $user ->access_token =\Yii::$app->security->generateRandomString();
//     $user ->auth_key =\Yii::$app->security->generateRandomString();


    // if($user->save()){
    //     return true;
    // }
    // \Yii::error("user was not saved.". \yii\helpers\VarDumper::dumpAsString( $user->errors));

    // return false;
    // }
    public function getDepartent()
{
    return $this->hasOne(Department::class, ['id' => 'department']);
        
}
 
}