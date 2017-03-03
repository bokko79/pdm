<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingStoreyParts;

/**
 * ProjectBuildingStoreyPartsSearch represents the model behind the search form about `common\models\ProjectBuildingStoreyParts`.
 */
class ProjectBuildingStoreyPartsSearch extends ProjectBuildingStoreyParts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_building_storey_id'], 'integer'],
            [['type', 'name', 'mark', 'structure', 'description'], 'safe'],
            [['area'], 'number'],
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
        $query = ProjectBuildingStoreyParts::find();

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
            'project_building_storey_id' => $this->project_building_storey_id,
            'area' => $this->area,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'structure', $this->structure])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
