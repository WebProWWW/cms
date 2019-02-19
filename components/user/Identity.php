<?php

namespace components\user;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class Identity
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
class Identity extends ActiveRecord implements IdentityInterface
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
     * @return Identity|null
     */
    public static function findByEmail($email)
    {
        return self::findOne([
            'email' => $email,
            'status' => Access::STATUS_ACTIVE,
        ]);
    }

    /**
     * Identity Implements
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * @param int|string $id
     * @return Identity|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id'=>$id, 'status'=>Access::STATUS_ACTIVE]);
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