<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bnm_categories".
 *
 * @property integer $ID
 * @property string $name
 *
 * @property categoryRelationships[] $categoryRelationships
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bnm_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200]
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
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategoryRelationship()
	{
		return $this->hasMany(CategoryRelationship::className(), ['category' => 'ID']);
	}

}
