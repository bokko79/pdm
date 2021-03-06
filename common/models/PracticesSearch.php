<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Practices;

/**
 * PracticesSearch represents the model behind the search form about `common\models\Practices`.
 */
class PracticesSearch extends Practices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id', 'engineer_id'], 'integer'],
            [['name', 'phone', 'email', 'fax'], 'safe'],
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
        $query = Practices::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy('name, engineer_id DESC'),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'location_id' => $this->location_id,
            'engineer_id' => $this->engineer_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fax', $this->fax]);

        return $dataProvider;
    }
}
