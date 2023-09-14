<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $Sno
 * @property string $Regno
 * @property string $quiz1
 * @property string $assign2
 * @property string $quiz
 * @property string $termpaper
 * @property string $quizassign
 * @property string $quizassgn2
 * @property string $test1
 * @property string $test2
 * @property string $test80
 * @property string $test15
 * @property string $testassign
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document'], 'required'],
            [['created_at', 'updated_at', 'created_by'], 'integer'],
            [['Sno', 'Regno', 'quiz1', 'assign2', 'quiz', 'termpaper', 'quizassign', 'quizassgn2', 'test1', 'test2', 'test80', 'test15', 'testassign'], 'string', 'max' => 255],
            [['document'],'file'],
            [['test1','test2', 'test80', 'test15', 'testassign'],'default', 'value' => 0]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Sno' => 'Sno',
            'Regno' => 'Regno',
            'quiz1' => 'Quiz1',
            'assign2' => 'Assign2',
            'quiz' => 'Quiz',
            'termpaper' => 'Termpaper',
            'quizassign' => 'Quizassign',
            'quizassgn2' => 'Quizassgn2',
            'test1' => 'Test1',
            'test2' => 'Test2',
            'test80' => 'Test80',
            'test15' => 'Test15',
            'testassign' => 'Testassign',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }
}
