<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bnm_users".
 *
 * @property integer $ID
 * @property string $name
 * @property string $pwd
 * @property integer $auth
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

	public $oldPwd;
	public $oldAuth;
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'bnm_users';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'pwd', 'auth'], 'required'],
			['name', 'unique'],
			[['auth'], 'integer'],
			[['name'], 'string', 'max' => 200],
			[['pwd'], 'string', 'max' => 100],
			[['authKey'], 'string', 'max' => 32],
			[['accessToken'], 'string', 'max' => 32],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'ID' => 'ID',
			'name' => '用户名',
			'pwd' => '密码',
			'auth' => '权限',
			'authType' => '权限',
			'authKey' => 'AuthKey',
			'accessToken' => 'AccessToken',
		];
	}
	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['accessToken' => $token]);
	}

	/**
	 * Finds user by username
	 *
	 * @param  string      $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['name' => $username]);
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->ID;
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->authKey;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param  string  $password password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->getSecurity()->validatePassword($password, $this->pwd);
		//return $password == $this->pwd;
	}

	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($this->isNewRecord) {
				$this->authKey = Yii::$app->security->generateRandomString();
			}
			if (Yii::$app->user->identity->auth == 0) {
				$this->auth = $this->oldAuth;
			}
			if ($this->pwd != $this->oldPwd)
				$this->pwd = Yii::$app->getSecurity()->generatePasswordHash($this->pwd);
			return true;
		}
		return false;
	}
	
	/**
    * @return \yii\db\ActiveQuery
    */
   public function getMedia()
   {
       return $this->hasMany(Media::className(), ['user' => 'ID']);
   }

	public function getAuthType()
	{
		if ($this->auth) return '管理员';
		return '编辑';
	}
}
