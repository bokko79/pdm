<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PhaseVolumes;

/**
 * PhaseVolumesSearch represents the model behind the search form about `common\models\PhaseVolumes`.
 */
class PhaseVolumesSearch extends PhaseVolumes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'volume_id', 'file_id'], 'integer'],
            [['phase', 'no', 'info'], 'safe'],
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
        $query = PhaseVolumes::find();

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
            'volume_id' => $this->volume_id,
            'file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['like', 'phase', $this->phase])
            ->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
