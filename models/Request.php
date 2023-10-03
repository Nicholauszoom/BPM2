<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int|null $payment
 * @property int|null $item
 * @property int|null $ref
 * @property int|null $task_id
 * @property int|null $department
 * @property string $description
 * @property int|null $amount
 * @property int|null $analysis_id
 * @property int|null $project_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
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
            [['item'], 'required'],
            [['payment', 'ref', 'amount', 'created_at', 'project_id','updated_at', 'created_by','analysis_id','department','status','viewed'], 'integer'],
            [['description','item'], 'string'],
            [['description'], 'default', 'value' => 'comments'],
            [['status','viewed'], 'default', 'value' => 0],
          

            [['viewed'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment' => 'Payment mode',
            'item' => 'Item',
            'ref' => 'Quantity',
            'analysis_id'=> 'analysis Id',
            'department'=>'Department',
            'amount' => 'Amount',
            'status'=> 'Approval',
            'viewed'=>'Viewed',
            'project_id'=>'Project Id',
            'description'=> 'Comment',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    public function getItem()
    {
        return $this->hasOne(Analysis::class, ['id' => 'item']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department']);
    }
    
}
