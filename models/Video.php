<?php

namespace app\models;

use Yii;

use yii\imagine\Image;
use yii\db\ActiveQuery;
use yii\base\Security;
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
class Video extends Media
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
		return array_merge(parent::attributeLabels(), 
		[
			'url' => '视频链接',
			'imageFile' => '缩略图',
			'author' => '作者',
			'category' => '分类',
		]);
	}

	public static function find()
	{
		return (new ActiveQuery(get_called_class()))->with('author')->andWhere(['bnm_media.type' => 1]);
	}

	public function upload()
	{
		$this->user = Yii::$app->user->identity->ID;
		$this->type = 1;
		$url = '';
		if ($this->imageFile) {
			$name = md5($this->imageFile->baseName) . Yii::$app->security->generateRandomString();
			$url = 'uploads/' . $name . '.' . $this->imageFile->extension;
			$this->thumbnail = 'uploads/thumb_' . $name . '.' . $this->imageFile->extension;
		}
		if ($this->validate()) {
			$this->imageFile && $this->imageFile->saveAs($url);
			$this->imageFile && Image::thumbnail($url, 320, 240) ->save($this->thumbnail, ['quality' => 80]);
			return true;
		}
		return false;
	}

}
