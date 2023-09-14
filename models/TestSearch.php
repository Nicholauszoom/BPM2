<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Test;

/**
 * TestSearch represents the model behind the search form of `app\models\Test`.
 */
class TestSearch extends Test
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by',], 'integer'],
            [['Sno', 'Regno', 'quiz1', 'assign2', 'quiz', 'termpaper', 'quizassign', 'quizassgn2', 'test1',  'test80', 'test15', 'testassign'], 'safe'],
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
        $query = Test::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'Sno', $this->Sno])
            ->andFilterWhere(['like', 'Regno', $this->Regno])
            ->andFilterWhere(['like', 'quiz1', $this->quiz1])
            ->andFilterWhere(['like', 'assign2', $this->assign2])
            ->andFilterWhere(['like', 'quiz', $this->quiz])
            ->andFilterWhere(['like', 'termpaper', $this->termpaper])
            ->andFilterWhere(['like', 'quizassign', $this->quizassign])
            ->andFilterWhere(['like', 'quizassgn2', $this->quizassgn2])
            ->andFilterWhere(['like', 'test1', $this->test1])
            ->andFilterWhere(['like', 'test80', $this->test80])
            ->andFilterWhere(['like', 'test15', $this->test15])
            ->andFilterWhere(['like', 'testassign', $this->testassign]);

        return $dataProvider;
    }
}
