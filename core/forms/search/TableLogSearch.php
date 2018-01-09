<?php

namespace core\forms\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\infrastructure\TableLog;

/**
 * TableLogSearch represents the model behind the search form about `core\entities\infrastructure\TableLog`.
 */
class TableLogSearch extends TableLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'table_id', 'text'], 'integer'],
            [['datetime'], 'safe'],
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
        $query = TableLog::find();

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
            'text' => $this->text,
            'datetime' => $this->datetime,
        ]);

        return $dataProvider;
    }
}
