<?php

namespace core\forms\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\infrastructure\Table;

/**
 * TableSearch represents the model behind the search form about `core\entities\infrastructure\Table`.
 */
class TableSearch extends Table
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'game_name', 'started', 'closed', 'owner_id', 'winner_id', 'bank'], 'integer'],
            [['datetime_start', 'datetime_end'], 'safe'],
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
        $query = Table::find();

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
            'datetime_start' => $this->datetime_start,
            'datetime_end' => $this->datetime_end,
            'game_name' => $this->game_name,
            'started' => $this->started,
            'closed' => $this->closed,
            'owner_id' => $this->owner_id,
            'winner_id' => $this->winner_id,
            'bank' => $this->bank,
        ]);
        return $dataProvider;
    }
}
