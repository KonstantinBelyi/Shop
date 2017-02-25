<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;

class AccountActivation extends Model
{
    //app/model/User
    private $_user;

    //создает форму модели данного ключа
    public function __construct($key, $config = [])
    {
        if (empty($key) || !is_string($key))
        {
            throw new InvalidParamException('Ключ активации не может быть пустым.');
        }

        $this->_user = User::findBySecretKey($key);

        if (!$this->_user)
        {
            throw new InvalidParamException('Неправильный ключ активации.');
        }

        parent::__construct($config);
    }

    //активирует нового пользователя
    public function activateAccount()
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removeSecretKey();

        return $user->save();
    }
}