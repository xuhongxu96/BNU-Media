<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Message;
use app\models\CategoryRelationship;
use app\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
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
	 * Lists all Message models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new MessageSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Message model.
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
	 * Creates a new Message model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Message();
		$data = Yii::$app->request->post();
		$ret = $model->load($data);
		$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
		if ($ret && $model->upload() && $model->save()) {
			if(isset($data['Message']['categoryID'])) {
				foreach($data['Message']['categoryID'] as $val) {
					$relation = new CategoryRelationship();
					$relation->media = $model->ID;
					$relation->category = $val;
					$relation->type = 2;
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
	 * Updates an existing Message model.
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
			if(isset($data['Message']['categoryID'])) {
				foreach($data['Message']['categoryID'] as $val) {
					$relation = new CategoryRelationship();
					$relation->media = $id;
					$relation->category = $val;
					$relation->type = 2;
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
	 * Deletes an existing Message model.
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
	 * Finds the Message model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Message the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Message::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
