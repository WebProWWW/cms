<?php

namespace components\user;

use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;

/**
 * Class Model
 * @package components\user
 *
 * @property integer   $id
 * @property string    $username
 * @property string    $email
 * @property integer   $status
 * @property string    $role
 * @property string    $auth_key
 * @property string    $password_hash
 * @property string    $password_reset_token
 * @property string    $email_confirm_token
 * @property integer   $created_at
 * @property integer   $updated_at
 */
class Model extends ActiveRecord implements IdentityInterface
{

    public static function tableName() { return 'user'; }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param string $email
     * @return Model|null
     */
    public static function findByEmail($email)
    {
        return self::findOne([
            'email' => $email,
            'status' => Access::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param string $token
     * @return Model|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => Access::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function setPassword($password)
    {
        try {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * remove password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @param string $token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = ArrayHelper::getValue(Yii::$app->params, 'user.passwordResetTokenExpire', 3600);
        return $timestamp + $expire >= time();
    }

    /**
     * generatePasswordResetToken
     */
    public function generatePasswordResetToken()
    {
        $token = 'QqWwEeRrTtYy'.time();
        try {
            $token = Yii::$app->security->generateRandomString();
        } catch (Exception $e) {}
        $this->password_reset_token = $token . '_' . time();
    }

    /**
     * Identity Implements
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * @param int|string $id
     * @return Model|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return self::findOne([
            'id'=>$id,
            'status'=>Access::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken Not Supported');
    }

    /**
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->primaryKey;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}

/* Class Model */