<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingStoreyPartRooms;

/**
 * ProjectBuildingStoreyPartRoomsSearch represents the model behind the search form about `common\models\ProjectBuildingStoreyPartRooms`.
 */
class ProjectBuildingStoreyPartRoomsSearch extends ProjectBuildingStoreyPartRooms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_building_storey_part_id'], 'integer'],
            [['type', 'name', 'mark', 'flooring'], 'safe'],
            [['circumference', 'length', 'width', 'height', 'sub_net_area', 'net_area'], 'number'],
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
        $query = ProjectBuildingStoreyPartRooms::find();

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
            'project_building_storey_part_id' => $this->project_building_storey_part_id,
            'circumference' => $this->circumference,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'sub_net_area' => $this->sub_net_area,
            'net_area' => $this->net_area,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'flooring', $this->flooring]);

        return $dataProvider;
    }
}
