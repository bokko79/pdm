<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PhaseVolumeInsets;

/**
 * PhaseVolumeInsetsSearch represents the model behind the search form about `common\models\PhaseVolumeInsets`.
 */
class PhaseVolumeInsetsSearch extends PhaseVolumeInsets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phase_volume_id', 'inset_id', 'file_id', 'requirement'], 'integer'],
            [['info'], 'safe'],
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
        $query = PhaseVolumeInsets::find();

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
            'phase_volume_id' => $this->phase_volume_id,
            'inset_id' => $this->inset_id,
            'file_id' => $this->file_id,
            'requirement' => $this->requirement,
        ]);

        $query->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
