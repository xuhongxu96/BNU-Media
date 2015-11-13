<?php

namespace app\models;


use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\base\Security;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "bnm_media".
 *
 * @property integer $ID
 * @property string $name
 * @property string $desp
 * @property string $url
 * @property string $thumbnail
 * @property integer $user
 * @property string $date
 * @property integer $type
 */
class Album extends Media
{

	public $imageFile;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return array_merge(parent::rules(), [[['imageFile'], 'file', 'skipOnEmpty' => true, 'maxSize' => 2097152]]);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'imageFile' => '图片',
			'editor' => '编辑',
			'author' => '作者',
			'category' => '分类',
		]);
	}

	public static function find()
	{
		return (new ActiveQuery(get_called_class()))->with('editor')->andWhere(['bnm_media.type' => 0]);
	}

	public function upload()
	{
		$this->user = Yii::$app->user->identity->ID;
		$this->type = 0;
		if ($this->imageFile) {
			$name = md5($this->imageFile->baseName) . Yii::$app->security->generateRandomString();
			$this->url = 'uploads/' . $name . '.' . $this->imageFile->extension;
			$this->thumbnail = 'uploads/thumb_' . $name . '.' . $this->imageFile->extension;
		}
		if ($this->validate()) {
			$this->imageFile && $this->imageFile->saveAs($this->url);
			$this->imageFile && Image::thumbnail($this->url, 120, 80) ->save($this->thumbnail, ['quality' => 50]);
			return true;
		}
		return false;
	}

}
