<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectVolumeDrawings;

/**
 * ProjectVolumeDrawingsSearch represents the model behind the search form about `common\models\ProjectVolumeDrawings`.
 */
class ProjectVolumeDrawingsSearch extends ProjectVolumeDrawings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_volume_id', 'project_building_storey_id', 'scale'], 'integer'],
            [['type', 'number', 'name', 'title', 'note'], 'safe'],
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
        $query = ProjectVolumeDrawings::find();

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
            'project_volume_id' => $this->project_volume_id,
            'project_building_storey_id' => $this->project_building_storey_id,
            'scale' => $this->scale,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
