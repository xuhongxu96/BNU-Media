<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Category;
use app\models\Album;
use app\models\Video;
use app\models\Message;

class SiteController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
					'only' => ['logout'],
					'rules' => [
						[
							'actions' => ['logout'],
							'allow' => true,
							'roles' => ['@'],
						],
					],
				],
				'verbs' => [
					'class' => VerbFilter::className(),
						'actions' => [
							'logout' => ['post'],
						],
					],
				];
	}

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	public function actionIndex()
	{
		$query = Album::find();
		$query->leftJoin('bnm_category_relationships', 'bnm_category_relationships.media = bnm_media.ID');
		$query->leftJoin('bnm_categories', 'bnm_categories.ID = bnm_category_relationships.category');
		$query->distinct();
		$query->andWhere(['bnm_categories.name' => '展示']);
		$query->orderBy(['id' => SORT_DESC]);
		
		$slider = [];
		foreach ($query->all() as $item) {
			$slider[] = [
				'content' => "<img style='width:100%;' src='{$item->url}'>",
				'caption' => "<h2>{$item->name}</h2>",
				];
		}

		$sogou = file_get_contents("http://weixin.sogou.com/weixin?query=%E5%8C%97%E4%BA%AC%E5%B8%88%E8%8C%83%E5%A4%A7%E5%AD%A6");
		$pattern = '/ href="\/gzh\?openid=oIWsFtwcqc8F1tKXjaSc5lyW4rVo&amp;ext=(.*)" target/';
		preg_match($pattern, $sogou, $matches);
		return $this->render('index', [
			'slider' => $slider,
			'ext' => $matches[1],
		]);
	}

	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}


	public function actionAbout()
	{
		return $this->render('about');
	}

	public function actionMedia($type, $cat = 0, $order = 'date', $asc = 'desc', $name = "", $desp = "", $author = "") 
	{
		$query;
		$typeid;
		if ($type == 'album') {
			$query = Album::find();
			$typeid = 0;
		}
		else if ($type == 'video') {
			$query = Video::find();
			$typeid = 1;
		}
		else {
			$query = Message::find();
			$typeid = 2;
		}

		$pagination = new Pagination([
			'defaultPageSize' => 30,
			'totalCount' => $query->count(),
		]);

		$query->distinct();

		$catArr = [];
		if ($cat) {
			$query->joinWith("category");
			$catArr = explode(',', $cat);
			$query->andWhere(['or', ['bnm_category_relationships.category' => $catArr]]);
		}


		$query->joinWith("editor");

		$query->andFilterWhere(['like', 'bnm_media.name', $name]);
		$query->andFilterWhere(['like', 'bnm_media.desp', $desp]);

		$query->orderBy($order . ' ' . $asc)
			->offset($pagination->offset)
			->limit($pagination->limit);
			//->asArray()
		//

		$catQuery = Category::find()->joinWith("categoryRelationship")->andWhere(['bnm_category_relationships.type' => $typeid])->distinct();
		return $this->render('media', [
			'media' => $query->all(),
			'categories' => $catQuery->all(),
			'pagination' => $pagination,
			'catArr' => $catArr,
			'catUrl' => $cat,
			'oldCat' => ['cat' => $cat],
			'oldOrder' => ['order' => $order, 'asc' => $asc],
			'oldSearch' => ['name' => $name, 'desp' => $desp, 'author' => $author],
			'type' => $type,
			'typeid' => $typeid,
			'asc' => $asc,
			'order' => $order,
			'name' => $name,
			'desp' => $desp,
			'author' => $author,
		]);
	}

	public function actionAlbum($cat = 0, $order = 'date', $asc = "desc", $name = "", $desp = "", $author = "")
	{
		return $this->actionMedia('album', $cat, $order, $asc, $name, $desp, $author);
	}

	public function actionVideo($cat = 0, $order = 'date',$asc = "desc", $name = "", $desp = "", $author = "")
	{
		return $this->actionMedia('video', $cat, $order, $asc, $name, $desp, $author);
	}

	public function actionMessage($cat = 0, $order = 'date',$asc = "desc", $name = "", $desp = "", $author = "")
	{
		return $this->actionMedia('message', $cat, $order, $asc, $name, $desp, $author);
	}
}
