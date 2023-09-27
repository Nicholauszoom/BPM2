<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tdetails".
 *
 * @property int $id
 * @property int|null $site_visit
 * @property int|null $end_clarificatiion
 * @property int|null $tender_id
 * @property int|null $amount
 * @property int|null $percentage
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Tdetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tdetails';
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
            [['site_visit','created_at', 'updated_at', 'created_by','tender_id','tender_security','office','amount','percentage'], 'integer'],
            ['end_clarificatiion', 'date', 'format' => 'php:Y-m-d'],
            ['site_visit_date', 'date', 'format' => 'php:Y-m-d'],
            ['bidmeet', 'date', 'format' => 'php:Y-m-d'],
            ['bidmeet', 'compare', 'compareValue' => date('Y-m-d'), 'operator' => '>='],
            ['site_visit_date', 'compare', 'compareValue' => date('Y-m-d'), 'operator' => '>='],
            ['end_clarificatiion', 'compare', 'compareValue' => date('Y-m-d'), 'operator' => '>='],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_visit' => 'Site Visit',
            'end_clarificatiion' => 'End Clarificatiion',
            'tender_id'=>'Tender',
            'site_visit_date'=> 'Site Visit Date',
            'bidmeet'=>'Bid Meeting',
            'tender_security'=>' Tender Security',
            'office'=>'Office',
            'amount'=> 'Security Amount',
            'percentage'=>'Security Percentage',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    public function getOffice()
{
    return $this->hasOne(Office::class, ['id' => 'office']);
}

    
    public function beforeSave($insert)
    {
        if ($this-> end_clarificatiion && $this->site_visit_date&& $this->bidmeet) {
            $this-> end_clarificatiion = strtotime($this-> end_clarificatiion);
            $this->site_visit_date = strtotime($this->site_visit_date);
            $this->bidmeet = strtotime($this->bidmeet);
        }

        return parent::beforeSave($insert);
    }
}
