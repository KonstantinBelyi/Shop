<?php


namespace app\models;

use yii\base\Model;
use yii\base\InvalidParamException;

class ResetPassword extends Model
{
    public $password;

    //app/model/User
    private $_user;

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
        ];
    }

    //создает форму модели данного токена.
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token))
        {
            throw new InvalidParamException('Токен сброса пароля не может быть пустым.');
        }

        $this->_user = User::findByPasswordResetToken($token);

        if (!$this->_user)
        {
            throw new InvalidParamException('Неправильный токен сброса пароля.');
        }

        parent::__construct($config);
    }

    //заменяет пароль
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}