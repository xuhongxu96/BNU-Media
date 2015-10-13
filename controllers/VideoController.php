<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Video;
use app\models\CategoryRelationship;
use app\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['post'],
					],
				],
				'access' => [
					'class' => AccessControl::className(),
						'except' => ['view'],
						'rules' => [
							[
								'allow' => true,
								'roles' => ['@'],
							]
						]
					],
				];
	}

	/**
	 * Lists all Video models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new VideoSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Video model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
			]);
	}

	/**
	 * Creates a new Video model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Video();
		$data = Yii::$app->request->post();
		$ret = $model->load($data);
		$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
		if ($ret && $model->upload() && $model->save()) {
			if(isset($data['Video']['categoryID'])) {
				foreach($data['Video']['categoryID'] as $val) {
					$relation = new CategoryRelationship();
					$relation->media = $model->ID;
					$relation->category = $val;
					$relation->type = 1;
					$relation->save();
				}
			}
			return $this->redirect(['view', 'id' => $model->ID]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Video model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$data = Yii::$app->request->post();
		$ret = $model->load($data);
		$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
		if ($ret && $model->upload() && $model->save()) {
			CategoryRelationship::deleteAll(['media' => $id]);
			if(isset($data['Video']['categoryID'])) {
				foreach($data['Video']['categoryID'] as $val) {
					$relation = new CategoryRelationship();
					$relation->media = $id;
					$relation->category = $val;
					$relation->type = 1;
					$relation->save();
				}
			}
			return $this->redirect(['view', 'id' => $model->ID]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Video model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Video model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Video the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Video::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
