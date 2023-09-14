<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\filters\AccessControl;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $budget
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int $status
 * @property string $document
 * @property int $progress
 * @property int $tender_id
 * @property int|null $start_at
 * @property int|null $user_id
 *@property int|null $end_at
 
 * @property User $createdBy
 */
class Project extends \yii\db\ActiveRecord
{

  
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    public function behaviors(){
        return [
            TimestampBehavior::class,
            [
                'class'=>BlameableBehavior::class,
                'updatedByAttribute'=>false,
            ],
          
           
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'description', 'budget','status'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at','progress','status','isViewed', 'created_by','user_id','tender_id'], 'integer'],
            [[ 'budget'], 'string', 'max' => 255],
            
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['document'], 'file'],
            [['progress'], 'integer', 'min' => 0, 'max' => 100],
            // [['start_at','end_at'], 'date', 'format' => 'MM-dd-yyyy'],
            [['isViewed'], 'default', 'value' => 0],

            ['start_at', 'date', 'format' => 'php:Y-m-d'],
            ['end_at', 'date', 'format' => 'php:Y-m-d'],

            [['isViewed'], 'safe'],


            // [['end_at',], 'compare', 'compareAttribute' => 'start_at', 'operator' => '>='],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'budget' => 'Contract value',
            'status' => 'Status',
            'progress' => 'Progress',
            'isViewed'=>'isViewed',
            'tender_id'=>'tender',
            'user_id' => 'Project Manager',
            'start_at'=>'Start Date',
            'end_at'=> 'End Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'document' => 'Document',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getTasks()
    {
        return $this->hasMany(Task::class, ['project_id' => 'id']);
    }

  /**
     * @return ActiveQuery
     */
   
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    

public function getTender()
{
    return $this->hasOne(Tender::class, ['id' => 'tender_id']);
}

public function beforeSave($insert)
    {
        if ($this->start_at && $this->end_at) {
            $this->start_at = strtotime($this->start_at);
            $this->end_at = strtotime($this->end_at);
        }

        return parent::beforeSave($insert);
    }


    
 
}
