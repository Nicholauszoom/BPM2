<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tattachmentss".
 *
 * @property int $id
 * @property string $document
 * @property int|null $tender_id
 * 
 */
class Tattachmentss extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tattachmentss';
    }

    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['open_results'], 'required'],
            [['tender_id'], 'integer'],
            // [['open_results'], 'string', 'max' => 255],
            [['document','evaluation','negotiation','award','intention','arithmetic','audit','cancellation'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document' => 'Open Results',
            'tender_id' => 'Tender ID',
            'evaluation'=>'Evaluation letter',
            'negotiation'=>'Negotiation letter',
            'award'=>'Award letter',
            'intention'=>'Intention letter',
            'arithmetic'=>'Arithmetic letter',
            'audit'=>'Audit letter',
            'cancellation'=>'Cancellation letter',
           
        ];
    }
}
