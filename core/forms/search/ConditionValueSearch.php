<?php

namespace core\forms\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\infrastructure\ConditionValue;

/**
 * ConditionValueSearch represents the model behind the search form about `core\entities\infrastructure\ConditionValue`.
 */
class ConditionValueSearch extends ConditionValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'table_id', 'condition_id'], 'integer'],
            [['value'], 'safe'],
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
        $query = ConditionValue::find();

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
            'table_id' => $this->table_id,
            'condition_id' => $this->condition_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
