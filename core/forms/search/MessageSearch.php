<?php

namespace core\forms\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\communication\Message;

/**
 * MessageSearch represents the model behind the search form about `core\entities\communication\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'receiver_id', 'seen'], 'integer'],
            [['message_text', 'datetime'], 'safe'],
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
        $query = Message::find();

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
            'author_id' => $this->author_id,
            'receiver_id' => $this->receiver_id,
            'datetime' => $this->datetime,
            'seen' => $this->seen,
        ]);

        $query->andFilterWhere(['like', 'message_text', $this->message_text]);

        return $dataProvider;
    }
}
