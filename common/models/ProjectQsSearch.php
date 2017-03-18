<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectQs;

/**
 * ProjectQsSearch represents the model behind the search form about `common\models\ProjectQs`.
 */
class ProjectQsSearch extends ProjectQs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'subwork_id', 'position_id'], 'integer'],
            [['name', 'action'], 'safe'],
            [['qty'], 'number'],
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
        $query = ProjectQs::find();

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
            'subwork_id' => $this->subwork_id,
            'position_id' => $this->position_id,
            'qty' => $this->qty,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'action', $this->action]);

        $query->orderBy('subwork_id');

        return $dataProvider;
    }
}
