<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QsPositions;

/**
 * QsPositionsSearch represents the model behind the search form about `common\models\QsPositions`.
 */
class QsPositionsSearch extends QsPositions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subwork_id', 'action_id', 'unit'], 'integer'],
            [['name', 'subtext'], 'safe'],
            [['price'], 'number'],
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
        $query = QsPositions::find();

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
            'subwork_id' => $this->subwork_id,
            'action_id' => $this->action_id,
            'unit' => $this->unit,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subtext', $this->subtext]);

        return $dataProvider;
    }
}
