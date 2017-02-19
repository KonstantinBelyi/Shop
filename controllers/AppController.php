<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 09.02.2017
 * Time: 21:19
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
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

    protected function sendMail( $view, $session, $email_to, $model_order_id)
    {
        $site_email = Yii::$app->components['mailer']['transport']['username'];

        Yii::$app->mailer
            ->compose($view, ['session' => $session])
            ->setFrom([$site_email => 'E-Shop.com'])
            ->setTo($email_to)
            ->setSubject('Заказ ' . '№' . $model_order_id)
            ->send();
    }
}