<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Video;

/**
 * VideoSearch represents the model behind the search form about `app\models\Video`.
 */
class VideoSearch extends Video
{

	public $editor;
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['ID', 'user', 'type'], 'integer'],
			[['author', 'name', 'desp', 'url', 'thumbnail', 'date', 'editor'], 'safe'],
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
		$query = Video::find();

		$query->joinWith(['editor']);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$dataProvider->sort->attributes['editor'] = [
			'asc' => ['bnm_users.name' => SORT_ASC]
		];
		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
			'ID' => $this->ID,
			'user' => $this->user,
			'date' => $this->date,
			'type' => $this->type,
		]);

		$query->andFilterWhere(['like', 'bnm_media.name', $this->name])
			->andFilterWhere(['like', 'desp', $this->desp])
			->andFilterWhere(['like', 'author', $this->author])
			->andFilterWhere(['like', 'url', $this->url])
			->andFilterWhere(['like', 'bnm_users.name', $this->editor])
			->andFilterWhere(['like', 'thumbnail', $this->thumbnail]);

		return $dataProvider;
	}
}
