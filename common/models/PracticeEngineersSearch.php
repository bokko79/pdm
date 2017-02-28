<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PracticeEngineers;

/**
 * PracticeEngineersSearch represents the model behind the search form about `common\models\PracticeEngineers`.
 */
class PracticeEngineersSearch extends PracticeEngineers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'practice_id', 'engineer_id', 'status'], 'integer'],
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
        $query = PracticeEngineers::find();

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
            'practice_id' => $this->practice_id,
            'engineer_id' => $this->engineer_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
