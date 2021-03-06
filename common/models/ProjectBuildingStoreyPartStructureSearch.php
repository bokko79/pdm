<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingStoreyPartStructure;

/**
 * ProjectBuildingStoreyPartStructureSearch represents the model behind the search form about `common\models\ProjectBuildingStoreyPartStructure`.
 */
class ProjectBuildingStoreyPartStructureSearch extends ProjectBuildingStoreyPartStructure
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'integer'],
            [['construction', 'wall_external', 'wall_bearing', 'wall_internal', 'slab', 'columns', 'beam', 'stair', 'arch', 'door', 'window', 'chimney', 'facade', 'tinwork', 'woodwork', 'steelwork'], 'safe'],
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
        $query = ProjectBuildingStoreyPartStructure::find();

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

        $query->andFilterWhere(['like', 'construction', $this->construction])
            ->andFilterWhere(['like', 'wall_external', $this->wall_external])
            ->andFilterWhere(['like', 'wall_bearing', $this->wall_bearing])
            ->andFilterWhere(['like', 'wall_internal', $this->wall_internal])
            ->andFilterWhere(['like', 'slab', $this->slab])
            ->andFilterWhere(['like', 'columns', $this->columns])
            ->andFilterWhere(['like', 'beam', $this->beam])
            ->andFilterWhere(['like', 'stair', $this->stair])
            ->andFilterWhere(['like', 'arch', $this->arch])
            ->andFilterWhere(['like', 'door', $this->door])
            ->andFilterWhere(['like', 'window', $this->window])
            ->andFilterWhere(['like', 'chimney', $this->chimney])
            ->andFilterWhere(['like', 'facade', $this->facade])
            ->andFilterWhere(['like', 'tinwork', $this->tinwork])
            ->andFilterWhere(['like', 'woodwork', $this->woodwork])
            ->andFilterWhere(['like', 'steelwork', $this->steelwork]);

        return $dataProvider;
    }
}
