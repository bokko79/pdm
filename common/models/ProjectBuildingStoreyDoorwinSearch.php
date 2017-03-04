<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingStoreyDoorwin;

/**
 * ProjectBuildingStoreyDoorwinSearch represents the model behind the search form about `common\models\ProjectBuildingStoreyDoorwin`.
 */
class ProjectBuildingStoreyDoorwinSearch extends ProjectBuildingStoreyDoorwin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_building_storey_id', 'project_building_doorwin_id', 'lefts', 'rights', 'total'], 'integer'],
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
        $query = ProjectBuildingStoreyDoorwin::find();

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
            'project_building_doorwin_id' => $this->project_building_doorwin_id,
            'lefts' => $this->lefts,
            'rights' => $this->rights,
            'total' => $this->total,
        ]);

        return $dataProvider;
    }
}
