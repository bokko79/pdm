<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProfilePortfolio;

/**
 * ProfilePortfolioSearch represents the model behind the search form about `common\models\ProfilePortfolio`.
 */
class ProfilePortfolioSearch extends ProfilePortfolio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'start_year', 'current', 'end_year'], 'integer'],
            [['profile_type', 'portfolio_type', 'title', 'company', 'start_month', 'end_month', 'summary'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ProfilePortfolio::find();

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
            'profile_id' => $this->profile_id,
            'start_year' => $this->start_year,
            'current' => $this->current,
            'end_year' => $this->end_year,
        ]);

        $query->andFilterWhere(['like', 'profile_type', $this->profile_type])
            ->andFilterWhere(['like', 'portfolio_type', $this->portfolio_type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'start_month', $this->start_month])
            ->andFilterWhere(['like', 'end_month', $this->end_month])
            ->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
