<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectBuildingCharacteristics;

/**
 * ProjectBuildingCharacteristicsSearch represents the model behind the search form about `common\models\ProjectBuildingCharacteristics`.
 */
class ProjectBuildingCharacteristicsSearch extends ProjectBuildingCharacteristics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'integer'],
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
        $query = ProjectBuildingCharacteristics::find();

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
        ]);

        return $dataProvider;
    }
}
