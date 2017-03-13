<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingDoorwin;

/**
 * ProjectBuildingDoorwinSearch represents the model behind the search form about `common\models\ProjectBuildingDoorwin`.
 */
class ProjectBuildingDoorwinSearch extends ProjectBuildingDoorwin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pos_no', 'project_building_id', 'width', 'height', 'scale', 'file_id'], 'integer'],
            [['pos_type', 'type', 'name', 'description', 'frame', 'sash', 'opening_type', 'material', 'metal', 'note'], 'safe'],
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
        $query = ProjectBuildingDoorwin::find();

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
            'pos_no' => $this->pos_no,
            'project_building_id' => $this->project_building_id,
            'width' => $this->width,
            'height' => $this->height,
            'scale' => $this->scale,
            'file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['like', 'pos_type', $this->pos_type])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'frame', $this->frame])
            ->andFilterWhere(['like', 'sash', $this->sash])
            ->andFilterWhere(['like', 'opening_type', $this->opening_type])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'metal', $this->metal])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
