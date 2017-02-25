<?php

namespace app\controllers;

use Yii;
use app\models\RequestPasswordReset;
use app\models\ResetPassword;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class ResetController extends AppController
{
    //запрос сброса пароля
    public function actionRequestPasswordReset()
    {
        $model_request = new RequestPasswordReset();

        if ($model_request->load(Yii::$app->request->post()) && $model_request->validate())
        {
            if ($model_request->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций.');

                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'К сожалению, мы не можем сбросить пароль для этой электронной почты.');

                return $this->refresh();
            }
        }

        return $this->render('requestPasswordReset', compact('model_request'));
    }

    //сброс старого пароля и сохранение нового пароля
    public function actionResetPassword($key)
    {
        try
        {
            $model_reset = new ResetPassword($key);
        }
        catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model_reset->load(Yii::$app->request->post()) && $model_reset->validate() && $model_reset->resetPassword())
        {
            //Yii::$app->session->setFlash('success', 'Новый пароль был сохранен.');

            return $this->goHome();
        }

        return $this->render('resetPassword', compact('model_reset'));
    }
}