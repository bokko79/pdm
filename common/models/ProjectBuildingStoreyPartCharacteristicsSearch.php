<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingStoreyPartCharacteristics;

/**
 * ProjectBuildingStoreyPartCharacteristicsSearch represents the model behind the search form about `common\models\ProjectBuildingStoreyPartCharacteristics`.
 */
class ProjectBuildingStoreyPartCharacteristicsSearch extends ProjectBuildingStoreyPartCharacteristics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'integer'],
            [['function', 'access', 'entrance', 'position', 'shape', 'architecture', 'style', 'context', 'ventilation', 'lights', 'orientation', 'adjacent', 'environment'], 'safe'],
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
        $query = ProjectBuildingStoreyPartCharacteristics::find();

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

        $query->andFilterWhere(['like', 'function', $this->function])
            ->andFilterWhere(['like', 'access', $this->access])
            ->andFilterWhere(['like', 'entrance', $this->entrance])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'shape', $this->shape])
            ->andFilterWhere(['like', 'architecture', $this->architecture])
            ->andFilterWhere(['like', 'style', $this->style])
            ->andFilterWhere(['like', 'context', $this->context])
            ->andFilterWhere(['like', 'ventilation', $this->ventilation])
            ->andFilterWhere(['like', 'lights', $this->lights])
            ->andFilterWhere(['like', 'orientation', $this->orientation])
            ->andFilterWhere(['like', 'adjacent', $this->adjacent])
            ->andFilterWhere(['like', 'environment', $this->environment]);

        return $dataProvider;
    }
}
