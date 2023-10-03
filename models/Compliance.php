<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compliance".
 *
 * @property int $id
 * @property int|null $role_id
 * @property int|null $user_id
 * @property string|null $section
 */
class Compliance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compliance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'user_id','tender_id'], 'integer'],
            [['section'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'user_id' => 'User ID',
            'tender_id'=>'Tender Id',
            'section' => 'Section',
        ];
    }
}
