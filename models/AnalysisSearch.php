<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Analysis;

/**
 * AnalysisSearch represents the model behind the search form of `app\models\Analysis`.
 */
class AnalysisSearch extends Analysis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'cost', 'created_at', 'updated_at', 'created_by','unit'], 'integer'],
            [[ 'item', 'description', 'boq', 'files','project','source'], 'safe'],
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
        $query = Analysis::find();

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
            'quantity' => $this->quantity,
            'cost' => $this->cost,
            'unit' =>$this->unit,
            'source'=>$this->source,
            'project' => $this->project,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'boq', $this->boq])
            ->andFilterWhere(['like', 'files', $this->files]);

        return $dataProvider;
    }
}
