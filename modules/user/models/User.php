<?php

namespace modules\user\models;

use components\user\Access;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property int $status
 * @property string $role
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email_confirm_token
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord
{
    const SCENARIO_CREATE = 'ScenarioCreate';

    public $password_repeat = null;
    public $password = null;

    public static function tableName() { return 'user'; }


    public function behaviors()
    {
        return [ TimestampBehavior::class ];
    }


    public function rules()
    {
        return [
            [['username', 'email', 'status', 'role'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'role', 'password_hash', 'password_reset_token', 'email_confirm_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'trim'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['email_confirm_token'], 'unique'],
            [['password_repeat'], 'string'],
            [['password_repeat'], 'required', 'on' => self::SCENARIO_CREATE],
            [['password'], 'required', 'on' => self::SCENARIO_CREATE],
            [['password'], 'string', 'length' => [6, 60]],
            [['password'], 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'email' => 'Email',
            'status' => 'Статус',
            'role' => 'Роль',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email_confirm_token' => 'Email Confirm Token',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'statusName' => 'Статус',
            'roleName' => 'Роль',
            'password_repeat' => 'Повторите пароль',
            'password' => 'Пароль',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->password !== null) {
            $this->setPasswordHashAndAuthKey();
        }
        return parent::beforeSave($insert);
    }


    public function getStatusName()
    {
        return ArrayHelper::getValue(Access::statuses(), $this->status);
    }


    public function getRoleName()
    {
        return ArrayHelper::getValue(Access::roles(), $this->role);
    }

    private function setPasswordHashAndAuthKey()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_repeat);
        $this->auth_key = Yii::$app->security->generateRandomString(32);
    }

}
