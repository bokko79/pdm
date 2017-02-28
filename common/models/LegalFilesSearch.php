<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LegalFiles;

/**
 * LegalFilesSearch represents the model behind the search form about `common\models\LegalFiles`.
 */
class LegalFilesSearch extends LegalFiles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'file_id'], 'integer'],
            [['type', 'entity', 'value'], 'safe'],
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
        $query = LegalFiles::find();

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
            'entity_id' => $this->entity_id,
            'file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'entity', $this->entity])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
