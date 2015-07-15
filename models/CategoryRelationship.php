<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bnm_category_relationships".
 *
 * @property integer $ID
 * @property integer $media
 * @property integer $category
 * @property integer $type
 *
 * @property Categories $categoryItem
 * @property Media $media
 */
class CategoryRelationship extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bnm_category_relationships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media', 'category', 'type'], 'required'],
            [['media', 'category', 'type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'media' => '媒体',
            'category' => '分类',
            'type' => '类别',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryItem()
    {
        return $this->hasOne(Category::className(), ['ID' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['ID' => 'media']);
    }
}
