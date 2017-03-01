<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuilding;

/**
 * ProjectBuildingSearch represents the model behind the search form about `common\models\ProjectBuilding`.
 */
class ProjectBuildingSearch extends ProjectBuilding
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'building_id', 'units_total'], 'integer'],
            [['name', 'type', 'storey', 'ridge_orientation', 'characteristics'], 'safe'],
            [['building_line_dist', 'gross_area_part', 'gross_area', 'gross_area_above', 'gross_area_below', 'gross_built_area', 'net_area', 'ground_floor_area', 'occupancy_area', 'storey_height', 'roof_pitch', 'cost'], 'number'],
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
        $query = ProjectBuilding::find();

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
            'project_id' => $this->project_id,
            'building_id' => $this->building_id,
            'building_line_dist' => $this->building_line_dist,
            'gross_area_part' => $this->gross_area_part,
            'gross_area' => $this->gross_area,
            'gross_area_above' => $this->gross_area_above,
            'gross_area_below' => $this->gross_area_below,
            'gross_built_area' => $this->gross_built_area,
            'net_area' => $this->net_area,
            'ground_floor_area' => $this->ground_floor_area,
            'occupancy_area' => $this->occupancy_area,
            'storey_height' => $this->storey_height,
            'units_total' => $this->units_total,
            'roof_pitch' => $this->roof_pitch,
            'cost' => $this->cost,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'storey', $this->storey])
            ->andFilterWhere(['like', 'ridge_orientation', $this->ridge_orientation])   
            ->andFilterWhere(['like', 'characteristics', $this->characteristics]);

        return $dataProvider;
    }
}
