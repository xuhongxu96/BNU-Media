<?php

namespace app\models;

use Yii;
use yii\db\Expression;

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
 *
 * @property categoryRelationships[] $categoryRelationships
 * @property author $author
 */
class Media extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'bnm_media';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'url', 'thumbnail', 'user', 'type'], 'required'],
			[['user', 'type'], 'integer'],
			[['date'], 'safe'],
			[['name', 'desp', 'thumbnail'], 'string', 'max' => 200],
			[['url'], 'string', 'max' => 300]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'ID' => 'ID',
			'name' => '名称',
			'desp' => '描述',
			'url' => '原图',
			'thumbnail' => '缩略图',
			'user' => '作者',
			'date' => '日期',
			'type' => '类型',
			'categories' => '分类',
			'categoryID' => '分类',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasMany(CategoryRelationship::className(), ['media' => 'ID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAuthor()
	{
		return $this->hasOne(User::className(), ['ID' => 'user']);
	}

	public function getCategoryID()
	{
		$arr = \yii\helpers\ArrayHelper::index($this->getCategory()->select("category")->asArray()->all(), 'category');
		return array_keys($arr);
	}

	public function getCategories()
	{
		$content = '';
		foreach($this->category as $val) {
			$content .= $val->categoryItem->name . ' ';
		}
		return $content;
	}

	public function getCategoryArray()
	{
		$arr = \yii\helpers\ArrayHelper::index($this->getCategory()->joinWith('categoryItem')->all(), 'category');
		return $arr;
	}
}
