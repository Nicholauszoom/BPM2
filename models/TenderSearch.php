<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tender;

/**
 * TenderSearch represents the model behind the search form of `app\models\Tender`.
 */
class TenderSearch extends Tender
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'expired_at', 'status', 'created_at', 'updated_at', 'created_by','publish_at','budget'], 'integer'],
            [['title', 'description','PE','TenderNo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tender::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'expired_at' => $this->expired_at,
            'status' => $this->status,
            'PE' => $this->PE,
            'TenderNo' => $this->TenderNo,
            'budget' => $this->budget,
            'publish_at' => $this->publish_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
