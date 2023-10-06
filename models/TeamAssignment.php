<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team_assignment".
 *
 * @property int $id
 * @property int|null $team_id
 * @property int|null $user_id
 * @property int|null $created_by
 */
class TeamAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id', 'user_id', 'created_by','project_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Team ID',
            'user_id' => 'User ID',
            'created_by' => 'Created By',
            'project_id'=>'Project ID',
        ];
    }
}
