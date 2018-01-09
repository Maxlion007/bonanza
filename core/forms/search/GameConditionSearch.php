<?php

namespace core\forms\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\infrastructure\GameCondition;

/**
 * GameConditionSearch represents the model behind the search form about `core\entities\infrastructure\GameCondition`.
 */
class GameConditionSearch extends GameCondition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'required', 'sort', 'for_fool', 'for_poker', 'for_seka'], 'integer'],
            [['name', 'slug', 'type', 'default', 'variants_json'], 'safe'],
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
        $query = GameCondition::find();

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
            'required' => $this->required,
            'sort' => $this->sort,
            'for_fool' => $this->for_fool,
            'for_poker' => $this->for_poker,
            'for_seka' => $this->for_seka,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'default', $this->default])
            ->andFilterWhere(['like', 'variants_json', $this->variants_json]);

        return $dataProvider;
    }
}
