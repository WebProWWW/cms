<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-04-04 10:07
 */

namespace modules\site\models;

use components\user\Model as User;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use Exception;

/**
 * Class FormRestore
 * @package modules\site\models
 */
class FormRestore extends Model
{

    public $email;
    public $role;


    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'email' => 'Email',
        ];
    }


    /**
     * @return bool
     */
    public function send()
    {
        $errMsg = 'Произошла ошибка при восстановлении доступа. Пожалуйста, попробуйте еще раз.';
        if ($this->validate()) {
            $user = User::findByEmail($this->email);
            if (!$user or $user->role !== $this->role) {
                $this->addError('email', 'Указанный e-mail не зарегистрирован в системе');
                return false;
            }
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
                if (!$user->save()) {
                    $this->addError('email', $errMsg);
                    return false;
                }
            }
            try {
                Yii::$app->mailer->compose('password-reset', ['user' => $user])
                    ->setFrom(ArrayHelper::getValue(Yii::$app->params, 'mailer.from', 'bot@site.com'))
                    //->setFrom('asdasdasd')
                    ->setTo($this->email)
                    ->setSubject('Восстановление доступа')
                    ->send();
                return true;
            } catch (Exception $e) {
                $eMsg = YII_ENV_DEV ? $errMsg . '<br>' . $e->getMessage() : $errMsg;
                $this->addError('email', $eMsg);
                return false;
            }
        }
        return false;
    }

}

/* Class FormRestore */