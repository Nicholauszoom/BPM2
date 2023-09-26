<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_assignment".
 *
 * @property int $id
 * @property int|null $tender_id
 * @property int|null $updated_at
 */
class UserAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tender_id', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tender_id' => 'Tender ID',
            'updated_at' => 'Updated At',
        ];
    }
}
