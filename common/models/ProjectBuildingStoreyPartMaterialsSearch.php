<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingStoreyPartMaterials;

/**
 * ProjectBuildingStoreyPartMaterialsSearch represents the model behind the search form about `common\models\ProjectBuildingStoreyPartMaterials`.
 */
class ProjectBuildingStoreyPartMaterialsSearch extends ProjectBuildingStoreyPartMaterials
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'integer'],
            [['access', 'foundation', 'wall_external', 'wall_bearing', 'wall_internal', 'facade', 'flooring', 'ceiling', 'door', 'window', 'tinwork', 'stair', 'woodwork', 'steelwork', 'roof', 'light', 'sanitary', 'electrical', 'plumbing', 'hvac', 'chimney', 'furniture', 'kitchen', 'bathroom', 'lift', 'roofing'], 'safe'],
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
        $query = ProjectBuildingStoreyPartMaterials::find();

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

        $query->andFilterWhere(['like', 'access', $this->access])
            ->andFilterWhere(['like', 'foundation', $this->foundation])
            ->andFilterWhere(['like', 'wall_external', $this->wall_external])
            ->andFilterWhere(['like', 'wall_bearing', $this->wall_bearing])
            ->andFilterWhere(['like', 'wall_internal', $this->wall_internal])
            ->andFilterWhere(['like', 'facade', $this->facade])
            ->andFilterWhere(['like', 'flooring', $this->flooring])
            ->andFilterWhere(['like', 'ceiling', $this->ceiling])
            ->andFilterWhere(['like', 'door', $this->door])
            ->andFilterWhere(['like', 'window', $this->window])
            ->andFilterWhere(['like', 'tinwork', $this->tinwork])
            ->andFilterWhere(['like', 'stair', $this->stair])
            ->andFilterWhere(['like', 'woodwork', $this->woodwork])
            ->andFilterWhere(['like', 'steelwork', $this->steelwork])
            ->andFilterWhere(['like', 'roof', $this->roof])
            ->andFilterWhere(['like', 'light', $this->light])
            ->andFilterWhere(['like', 'sanitary', $this->sanitary])
            ->andFilterWhere(['like', 'electrical', $this->electrical])
            ->andFilterWhere(['like', 'plumbing', $this->plumbing])
            ->andFilterWhere(['like', 'hvac', $this->hvac])
            ->andFilterWhere(['like', 'chimney', $this->chimney])
            ->andFilterWhere(['like', 'furniture', $this->furniture])
            ->andFilterWhere(['like', 'kitchen', $this->kitchen])
            ->andFilterWhere(['like', 'bathroom', $this->bathroom])
            ->andFilterWhere(['like', 'lift', $this->lift])
            ->andFilterWhere(['like', 'roofing', $this->roofing]);

        return $dataProvider;
    }
}
