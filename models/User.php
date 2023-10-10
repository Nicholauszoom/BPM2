<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\components\UserIdentity;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $role_id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password','email'], 'required'],
            [['username','email'], 'string', 'min'=>4 ,'max' => 55],
            [['password', 'auth_key', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Full Name',
            'password' => 'Password',
            'email'=>'Email',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        return self:: find()->where(['access_token' => $token])->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }
     /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email'=>$email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->password);
    }

    public function getRoles()
    {
        return $this->hasMany(Role::class, ['id' => 'role_id'])
            ->viaTable('role_user', ['user_id' => 'id']);
    }
    
    // public function hasPermission($permissionName)
    // {
    //     $role = $this->role;
    //     if ($role) {
    //         $permissions = $role->getPermissions();
    //         foreach ($permissions as $permission) {
    //             if ($permission->name === $permissionName) {
    //                 return true;
    //             }
    //         }
    //     }
        
    //     return false;
    // }

    public function isAdmin()
    {
        // Check if the user has the 'admin' item_name in the auth_assignment table
        $isAdmin = AuthAssignment::find()
            ->where(['user_id' => $this->id, 'item_name' => 'admin'])
            ->exists();

        return $isAdmin;
    }

    public function generatePasswordResetToken()
    {
        $this->access_token = \Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->access_token = null;
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
}
   