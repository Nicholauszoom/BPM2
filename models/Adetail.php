<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adetail".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $activity_id
 * @property int|null $tender_id
 */
class Adetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id','tender_id'], 'integer'],
           [['activity_id'], 'safe'],
           ['submit_at', 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ',
            'activity_id' => 'Activity ',
            'submit_at'=> 'tender task submit date',
            'tender_id' => 'Tender ID',
        ];
    }

    public function getActivity()
    {
        return $this->hasOne(Activity::class, ['id' => 'activity_id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->submit_at) {
            $this->submit_at = strtotime($this->submit_at);
           
        }

        return parent::beforeSave($insert);
    }

}
