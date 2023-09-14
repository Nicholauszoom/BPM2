<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "analysis".
 *
 * @property int $id
 * @property int $unit
 * @property int $setunit
 * @property int $unitprofit
 * @property string $item
 * @property string $source
 * @property string $description
 * @property int $quantity
 * @property int $cost
 * @property int $project
 * @property int $status
 * @property string $boq
 * @property string $files
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Analysis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'analysis';
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
            // [[ 'item', 'quantity', 'unit','project','source','cost'], 'required'],
            [['files'], 'required'],
            [['quantity', 'cost', 'created_at', 'updated_at', 'created_by','project','status','unit','setunit','unitprofit'], 'integer'],
            [['item', 'description','source'], 'string', 'max' => 255],
            [['files'],'file'],
            [['boq','status'],'default','value'=>0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => 'Item',
            'description' =>'Unit',
            'quantity' => 'Quantity',
            'cost' => 'Amount(By.price)',
            'unit'=> 'Unit Price(TSH)',
            'setunit'=> 'Amount(BOQ/Customer)',
            'boq' => 'attachment(analysis)',
            'project' => 'Project',
            'files' => 'Files',
            'status'=>'Status',
            'source'=>'Source',
            'unitprofit'=> 'Unit Profit',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project']);
    }
    
}
