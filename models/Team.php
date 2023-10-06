<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int $task_id
 * @property int $project_id
 * @property int $user_id
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }



    public function behaviors(){
        return [
            TimestampBehavior::class,
            [
                'class'=>BlameableBehavior::class,
                'updatedByAttribute'=>false,
            ],

            // [

            //     'class'=>SluggableBehavior::class,
            //     'attribute'=>'title',
            // ],
            
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status','project_id','user_id'], 'required'],
            [['status', 'created_at', 'updated_at','project_id', 'created_by','team_no'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id'=>'Member',
            'status' => 'Status',
            'team_no'=>'Project  Req.. team',
            'project_id' => 'project_id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
           
        ];
    }





public function getUsers()
{
    return $this->hasMany(User::class, ['id' => 'user_id'])
        ->viaTable('team_user', ['team_id' => 'id']);
}
}
