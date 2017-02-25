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

    //создает форму модели данного ключа.
    public function __construct($key, $config = [])
    {
        if (empty($key) || !is_string($key))
        {
            throw new InvalidParamException('Ключ сброса пароля не может быть пустым.');
        }

        $this->_user = User::findBySecretKey($key);

        if (!$this->_user)
        {
            throw new InvalidParamException('Неправильный ключ сброса пароля.');
        }

        parent::__construct($config);
    }

    //заменяет пароль
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removeSecretKey();

        return $user->save(false);
    }
}