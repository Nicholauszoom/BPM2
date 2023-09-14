<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tender".
 *
 * @property int $id
 * @property string $PE
 * @property string $TenderNo
 * @property string $title
 * @property string $description
 * @property string $document
 * @property string $submission
 * @property int|null $publish_at
 * @property int|null $expired_at
 * @property int|null $assigned_to
 * @property int|null $submit_to
 * @property int|null $supervisor
 * @property int $status
 * @property int $budget
 * @property int $isViewed
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Tender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tender';
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
            [['title', 'description', 'status'], 'required'],
            [[ 'status', 'updated_at', 'created_by','budget','isViewed','assigned_to','supervisor','submit_to'], 'integer'],
            [['title', 'description','PE','TenderNo'], 'string', 'max' => 255],
            [['isViewed'], 'default', 'value' => 0],
            [['expired_at','publish_at','document','isViewed','submission'], 'safe'],
            

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'expired_at' => 'Submitted Date',
            'status' => 'Status',
            'budget'=>'bid price ',
            'PE'=>'Proqurement Entity',
            'TenderNo'=>'Tender Number',
            'isViewed'=>'isViewed',
            'publish_at'=>'Published Date',
            'document'=>'tender Attachment',
            'submission'=>'Tender Submition Document',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'assigned_to'=>'Assigned To',
            'submit_to'=>'Submitted To',
            'supervisor'=>'Supervisor',
            'created_by' => 'Created By',
        ];
    }


public static function findByTitle($title)
{
    return self::findOne(['title'=>$title]);
}

public function getUser()
{
    return $this->hasOne(User::class, ['id' => 'assigned_to']);
}

public function getDepartment()
{
    return $this->hasOne(Department::class, ['id' => 'submit_to']);
}



}