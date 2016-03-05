<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "bnm_interview".
 *
 * @property integer $id
 * @property string $name
 * @property string $unit
 * @property string $place
 * @property string $start_time
 * @property string $stop_time
 * @property string $contact
 * @property string $contact_method
 * @property string $summary
 * @property string $service
 * @property string $others
 * @property string $created_at
 * @property string $updated_at
 */
class Interview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bnm_interview';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'unit', 'place', 'start_time', 'stop_time', 'contact', 'contact_method', 'summary', 'service'], 'required'],
            [['start_time', 'stop_time', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['reply'], 'string', 'max' => 500],
            [['unit', 'contact_method', 'others'], 'string', 'max' => 300],
            [['place', 'summary', 'service'], 'string', 'max' => 500],
            [['contact'], 'string', 'max' => 100]
        ];
    }

    public function beforeSave($insert) 
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->ip = Yii::$app->getRequest()->getUserIP();
            }
            return true;
        }
        return false;
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '活动名称',
            'unit' => '主办单位',
            'place' => '活动地点',
            'start_time' => '开始时间',
            'stop_time' => '结束时间',
            'contact' => '联系人',
            'contact_method' => '联系方式',
            'summary' => '活动概要（背景、目的、出席人员、简介等）',
            'service' => '申请的媒体服务（文字记者、摄影、电视台、社会媒体等）',
            'others' => '其他需要说明',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'ip' => 'IP',
            'reply' => '回复',
        ];
    }
}
