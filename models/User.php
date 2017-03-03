<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = '0';
    const STATUS_ACTIVE = '1';

    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    //=============================IdentityInterface=========================================================

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    //============================Login & Signup==========================================================

    //создает хэш пароля из пароля и устанавливает его в модель
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    //формирует "Запомнить" ключ аутентификации
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    //находит пользователя по электронной почте
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    //подтверждает пароль
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

        //==============================ResetPassword & AccountActivation========================================================

    //проверяет, если секретный ключ действителен
    public static function isSecretKeyValid($key)
    {
        if (empty($key))
        {
            return false;
        }

        $timestamp = (int) substr($key, strrpos($key, '_') + 1);
        $expire = Yii::$app->params['user.SecretKeyExpire'];
        return $timestamp + $expire >= time();
    }

    //создает новый секретный ключ
    public function generateSecretKey()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    //находит пользователя с помощью секретного ключа
    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyValid($key)) {
            return null;
        }

        return static::findOne(['password_reset_token' => $key]);
    }

    //удаляет секретный ключ
    public function removeSecretKey()
    {
        $this->password_reset_token = null;
    }
}
