<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
//            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Это имя пользователя уже используется.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Этот адрес электронной почты уже используется'],

            ['status', 'default', 'value' => User::STATUS_DELETED, 'on' => 'emailActivation'],
//            ['status', 'in', 'range' => [
//                User::STATUS_DELETED,
//                User::STATUS_ACTIVE,
//            ]],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    //регистрация пользователя
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($this->scenario === 'emailActivation')
            $user->generateSecretKey();

        return $user->save() ? $user : null;
    }

    //посылает электронное письмо со ссылкой для активации пользователя
    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['nameSite'] . ' робот'])
            ->setTo($this->email)
            ->setSubject('Активация для  ' . Yii::$app->params['nameSite'])
            ->send();
    }
}