<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Album;

/**
 * AlbumSearch represents the model behind the search form about `app\models\Album`.
 */
class AlbumSearch extends Album
{

	public $author;
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['ID', 'user', 'type'], 'integer'],
			[['name', 'desp', 'url', 'thumbnail', 'date', 'author'], 'safe'],
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
		$query = Album::find();

		$query->joinWith(['author']);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$dataProvider->sort->attributes['author'] = [
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
			->andFilterWhere(['like', 'url', $this->url])
			->andFilterWhere(['like', 'bnm_users.name', $this->author])
			->andFilterWhere(['like', 'thumbnail', $this->thumbnail]);

		return $dataProvider;
	}
}
