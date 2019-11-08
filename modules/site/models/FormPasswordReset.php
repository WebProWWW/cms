<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-04-10 01:00
 */

namespace modules\site\models;

use components\user\Model as User;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class FormPasswordReset extends Model
{

    public $password;
    public $password_repeat;

    private $_user;

    public function __construct($token, $config=[])
    {
        if (empty($token) or !is_string($token)) {
            throw new NotFoundHttpException();
        }
        if (!$this->_user = User::findByPasswordResetToken($token)) {
            throw new NotFoundHttpException();
        }
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            [['password'], 'string', 'length' => [6, 60]],
            [['password'], 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'password' => 'Новый пароль',
            'password_repeat' => 'Повторите новый пароль',
        ];
    }

    /**
     * @return bool
     */
    public function resetPassword()
    {
        if (!$this->validate()) {
            return false;
        }
        if (!$this->_user->setPassword($this->password)) {
            return false;
        }
        $this->_user->removePasswordResetToken();
        return $this->_user->save(false);
    }

}