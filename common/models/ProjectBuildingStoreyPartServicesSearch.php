<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingStoreyPartServices;

/**
 * ProjectBuildingStoreyPartServicesSearch represents the model behind the search form about `common\models\ProjectBuildingStoreyPartServices`.
 */
class ProjectBuildingStoreyPartServicesSearch extends ProjectBuildingStoreyPartServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'integer'],
            [['heating', 'ac', 'ventilation', 'gas', 'sprinkler', 'water', 'sewage', 'phone', 'tv', 'electricity', 'catv', 'internet', 'lift', 'pool', 'geotech', 'traffic', 'construction', 'fire', 'special'], 'safe'],
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
        $query = ProjectBuildingStoreyPartServices::find();

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
            'project_building_storey_part_id' => $this->project_building_storey_part_id,
        ]);

        $query->andFilterWhere(['like', 'heating', $this->heating])
            ->andFilterWhere(['like', 'ac', $this->ac])
            ->andFilterWhere(['like', 'ventilation', $this->ventilation])
            ->andFilterWhere(['like', 'gas', $this->gas])
            ->andFilterWhere(['like', 'sprinkler', $this->sprinkler])
            ->andFilterWhere(['like', 'water', $this->water])
            ->andFilterWhere(['like', 'sewage', $this->sewage])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'tv', $this->tv])
            ->andFilterWhere(['like', 'electricity', $this->electricity])
            ->andFilterWhere(['like', 'catv', $this->catv])
            ->andFilterWhere(['like', 'internet', $this->internet])
            ->andFilterWhere(['like', 'lift', $this->lift])
            ->andFilterWhere(['like', 'pool', $this->pool])
            ->andFilterWhere(['like', 'geotech', $this->geotech])
            ->andFilterWhere(['like', 'traffic', $this->traffic])
            ->andFilterWhere(['like', 'construction', $this->construction])
            ->andFilterWhere(['like', 'fire', $this->fire])
            ->andFilterWhere(['like', 'special', $this->special]);

        return $dataProvider;
    }
}
