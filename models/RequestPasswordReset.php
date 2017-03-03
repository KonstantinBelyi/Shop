<?php


namespace app\models;

use Yii;
use yii\base\Model;

class RequestPasswordReset extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => 'app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Нет пользователя с такой электронной почтой.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
        ];
    }

    //посылает электронное письмо со ссылкой для сброса пароля
    public function sendEmail()
    {
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user)
        {
            return false;
        }

        if (!User::isSecretKeyValid($user->password_reset_token))
        {
            $user->generateSecretKey();
            if (!$user->save())
            {
                return false;
            }
        }

        return Yii::$app->mailer
            ->compose(
                ['html' => 'passwordResetToken-html'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['nameSite'] . ' робот'])
            ->setTo($this->email)
            ->setSubject('Восстановление пароля для  ' . Yii::$app->params['nameSite'])
            ->send();
    }
}