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
 * property int $cotedAmount
 * @property string $serio
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
            [['quantity', 'cost', 'created_at', 'updated_at', 'created_by','project','status','unit','unitprofit'], 'integer'],
            [['item', 'description','source','serio','cotedAmount','setunit'], 'string', 'max' => 255],
            [['files'],'file'],
            [['boq','status','unit'],'default','value'=>0],
            [['source'], 'default', 'value'=>'source'],
            [['setunit'], 'validateSetunit'],
        ];
    }
    public function validateSetunit($attribute, $params)
{
    $setunit = str_replace(',', '', $this->$attribute);
    $unit = $this->unit;

    if ($setunit <= $unit) {
        $this->addError($attribute, '*cross check at buying unit price must be less to cotted unit price.');
    }
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
            'cost' => 'Amount(Buy.price)',
            'unit'=> 'Unit Price(TSH)',
            'setunit'=> 'Unit Price(cotted)',
            'boq' => 'attachment(analysis)',
            'project' => 'Project',
            'files' => 'Files',
            'status'=>'Status',
            'source'=>'Source',
            'serio'=>'Serio No',
            'cotedAmount'=>'Amount(cotted)',
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
