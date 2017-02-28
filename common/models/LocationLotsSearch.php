<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LocationLots;

/**
 * LocationLotsSearch represents the model behind the search form about `common\models\LocationLots`.
 */
class LocationLotsSearch extends LocationLots
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'location_id'], 'integer'],
            [['lot', 'type'], 'safe'],
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
        $query = LocationLots::find();

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
            'location_id' => $this->location_id,
        ]);

        $query->andFilterWhere(['like', 'lot', $this->lot]);
        $query->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
