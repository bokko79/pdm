<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingParts;

/**
 * ProjectBuildingPartsSearch represents the model behind the search form about `common\models\ProjectBuildingParts`.
 */
class ProjectBuildingPartsSearch extends ProjectBuildingParts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'building_type_id'], 'integer'],
            [['name', 'storeys', 'description'], 'safe'],
            [['gross_area', 'net_area', 'height'], 'number'],
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
        $query = ProjectBuildingParts::find();

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
            'project_id' => $this->project_id,
            'building_type_id' => $this->building_type_id,
            'gross_area' => $this->gross_area,
            'net_area' => $this->net_area,
            'height' => $this->height,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'storeys', $this->storeys])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
