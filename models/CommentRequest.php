<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment_request".
 *
 * @property int $id
 * @property int|null $comment_id
 * @property int|null $request_id
 * @property int|null $project_id
 */
class CommentRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_id', 'request_id', 'project_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'request_id' => 'Request ID',
            'project_id' => 'Project ID',
        ];
    }
}
