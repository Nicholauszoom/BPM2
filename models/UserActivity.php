<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_activity".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $activity_id
 */
class UserActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id','activity_id','tender_id', 'assign'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'activity_id' => 'Activity',
            'tender_id'=>'tender ID',
            'assign'=> 'Assign',
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
}
