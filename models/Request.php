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
            [['payment', 'item', 'ref', 'amount', 'created_at', 'updated_at', 'created_by','task_id','department','status'], 'integer'],
            [['description'], 'string'],
            [['description'], 'default', 'value' => 'comments'],
            [['status'], 'default', 'value' => 0],
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
            'task_id'=> 'Task Id',
            'department'=>'Department',
            'amount' => 'Amount',
            'status'=> 'Approval',
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
