<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-07 01:04
 */

namespace modules\site\models;

use components\user\Model as User;

use Yii;
use yii\base\Model;

/**
 * Class FormModel
 * @package modules\site\model
 *
 * @property User $user
 */
class FormLogin extends Model
{

    public $email;
    public $password;
    public $remember = true;
    private $_user;


    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['remember', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'remember' => 'Запомнить меня',
        ];
    }


    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            if (!$this->user or !$this->user->validatePassword($this->password)) {
                $this->addError('error', 'Неверный email или пароль');
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->user, $this->remember ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }

}