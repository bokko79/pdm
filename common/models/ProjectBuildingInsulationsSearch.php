<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingInsulations;

/**
 * ProjectBuildingInsulationsSearch represents the model behind the search form about `common\models\ProjectBuildingInsulations`.
 */
class ProjectBuildingInsulationsSearch extends ProjectBuildingInsulations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_id'], 'integer'],
            [['thermal', 'sound', 'hidro', 'fireproof', 'chemical'], 'safe'],
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
        $query = ProjectBuildingInsulations::find();

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
            'project_building_id' => $this->project_building_ids,
        ]);

        $query->andFilterWhere(['like', 'thermal', $this->thermal])
            ->andFilterWhere(['like', 'sound', $this->sound])
            ->andFilterWhere(['like', 'hidro', $this->hidro])
            ->andFilterWhere(['like', 'fireproof', $this->fireproof])
            ->andFilterWhere(['like', 'chemical', $this->chemical]);

        return $dataProvider;
    }
}
