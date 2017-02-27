<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AppController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
        ];
    }

    //установка метатегов
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title;

        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => "$keywords",
        ]);

        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => "$description",
        ]);
    }

    //очистка сессии
    protected function delSession($session)
    {
//        foreach ($session as $name => $value)
//            unset($session[$name]);
        unset($session['cart']);
        unset($session['cart.qty']);
        unset($session['cart.sum']);
    }
}