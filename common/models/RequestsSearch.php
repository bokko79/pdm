<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Requests;

/**
 * RequestsSearch represents the model behind the search form about `common\models\Requests`.
 */
class RequestsSearch extends Requests
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'building_id', 'location_id'], 'integer'],
            [['object_type', 'work', 'phase', 'description'], 'safe'],
            [['object_area', 'lot_area'], 'number'],
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
        $query = Requests::find();

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
            'client_id' => $this->client_id,
            'building_id' => $this->building_id,
            'location_id' => $this->location_id,
            'object_area' => $this->object_area,
            'lot_area' => $this->lot_area,
        ]);

        $query->andFilterWhere(['like', 'object_type', $this->object_type])
            ->andFilterWhere(['like', 'work', $this->work])
            ->andFilterWhere(['like', 'phase', $this->phase])
            ->andFilterWhere(['like', 'description', $this->description]);

        $query->orderBy('time DESC');

        return $dataProvider;
    }
}
