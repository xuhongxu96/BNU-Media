<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Interview;

/**
 * InterviewSearch represents the model behind the search form about `app\models\Interview`.
 */
class InterviewSearch extends Interview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['reply', 'name', 'unit', 'place', 'start_time', 'stop_time', 'contact', 'contact_method', 'summary', 'service', 'others', 'created_at', 'updated_at'], 'safe'],
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
        $query = Interview::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start_time' => $this->start_time,
            'stop_time' => $this->stop_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'contact_method', $this->contact_method])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'reply', $this->reply])
            ->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'others', $this->others]);

        return $dataProvider;
    }
}
