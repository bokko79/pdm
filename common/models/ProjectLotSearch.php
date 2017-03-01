<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectLot;

/**
 * ProjectLotSearch represents the model behind the search form about `common\models\ProjectLot`.
 */
class ProjectLotSearch extends ProjectLot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'conditions', 'parking_spaces', 'parking_disabled'], 'integer'],
            [['width', 'length', 'area', 'ground_level', 'road_level', 'underwater_level', 'green_area_reg', 'green_area', 'occupancy_reg', 'built_index_reg'], 'number'],
            [['disposition', 'type', 'ground', 'access', 'ownership', 'adjacent_border', 'services', 'description', 'note', 'legal', 'parking'], 'safe'],
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
        $query = ProjectLot::find();

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
            'conditions' => $this->conditions,
            'width' => $this->width,
            'length' => $this->length,
            'area' => $this->area,
            'ground_level' => $this->ground_level,
            'road_level' => $this->road_level,
            'underwater_level' => $this->underwater_level,
            'green_area_reg' => $this->green_area_reg,
            'green_area' => $this->green_area,
            'occupancy_reg' => $this->occupancy_reg,
            'built_index_reg' => $this->built_index_reg,
            'parking_spaces' => $this->parking_spaces,
            'parking_disabled' => $this->parking_disabled,
        ]);

        $query->andFilterWhere(['like', 'disposition', $this->disposition])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'ground', $this->ground])
            ->andFilterWhere(['like', 'access', $this->access])
            ->andFilterWhere(['like', 'ownership', $this->ownership])
            ->andFilterWhere(['like', 'adjacent_border', $this->adjacent_border])
            ->andFilterWhere(['like', 'services', $this->services])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'legal', $this->legal])
            ->andFilterWhere(['like', 'parking', $this->parking]);

        return $dataProvider;
    }
}
