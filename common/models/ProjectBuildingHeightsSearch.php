<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingHeights;

/**
 * ProjectBuildingHeightsSearch represents the model behind the search form about `common\models\ProjectBuildingHeights`.
 */
class ProjectBuildingHeightsSearch extends ProjectBuildingHeights
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_building_id'], 'integer'],
            [['part', 'type'], 'safe'],
            [['value'], 'number'],
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
        $query = ProjectBuildingHeights::find();

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
            'project_building_id' => $this->project_building_id,
            'value' => $this->value,
        ]);

        $query->andFilterWhere(['like', 'part', $this->part])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
