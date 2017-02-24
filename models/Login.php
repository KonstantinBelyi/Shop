<?php


namespace app\models;

use Yii;
use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            ['rememberMe', 'boolean'],
            //подтверждение пароля -> validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить',
        ];
    }

    //подтверждение пароля
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Неверное имя пользователя или пароль.');
            }
        }
    }

    //возвращает email пользователя
    protected function getUser()
    {
        return User::findByEmail($this->email);
    }

    //вход пользователя с помощью email и пароль
    public function login()
    {
        if ($this->validate())
        {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        else
        {
            return false;
        }
    }
}