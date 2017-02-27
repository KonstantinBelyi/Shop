<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Login;
use app\models\Signup;
use app\models\AccountActivation;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;

class SiteController extends AppController
{
    //регистрация пользователя
    public function actionSignup()
    {
        //$emailActivation = Yii::$app->params['emailActivation'];
        $model_signup = new Signup(['scenario' => 'emailActivation']);

        if ($model_signup->load(Yii::$app->request->post()))
        {
            if ($user = $model_signup->signup())
            {
                if ($user->status === User::STATUS_ACTIVE)
                {
                    if (Yii::$app->getUser()->login($user))
                    {
                        return $this->goHome();
                    }
                }
                else
                {
                    if ($model_signup->sendActivationEmail($user))
                    {
                        Yii::$app->session->setFlash('success',
                            'Письмо отправлено на E-mail 
                                <strong>' . Html::encode($user->email) .'</strong>
                             (проверте папку спам!).');
                    }
                    else
                    {
                        Yii::$app->session->setFlash('error', 'Ошибка. Письмо не отправлено.');
                    }
                }
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Ошибка при регистрации');
            }
        }

        return $this->render('signup', compact('model_signup'));
    }

    //активация аккаунта
    public function actionActivateAccount($key)
    {
        try
        {
            $model = new AccountActivation($key);
        }
        catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->activateAccount())
        {
            Yii::$app->session->setFlash('success', 'Активация прошла успешно.');
        }
        else
        {
            Yii::$app->session->setFlash('error', 'Ошибка активации.');
        }

        return $this->redirect(Url::to(['site/login']));
    }

    //вход пользователя
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model_login = new Login();

        if ($model_login->load(Yii::$app->request->post()) && $model_login->login())
        {
            return $this->goBack();
        }

        return $this->render('login', compact('model_login'));
    }

    //выход пользователя
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
