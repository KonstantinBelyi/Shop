<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Cart;
use app\models\Orders;
use app\models\OrderItems;

class CartController extends AppController
{
    public function actionAdd($id)
    {
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;

        $product = Product::findOne($id);
        if (empty($product))
            return false;

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product, $qty);

        if (!$id = Yii::$app->request->isAjax)
            return $this->redirect(Yii::$app->request->referrer);

        $this->layout = false;

        return $this->render('cart', compact('session'));
    }

    //============================================================

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();

        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        $this->layout = false;

        return $this->render('cart', compact('session'));
    }

    //============================================================

    public function actionDelItem($id)
    {
        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalculation($id);

        $this->layout = false;

        return $this->render('cart', compact('session'));
    }

    //============================================================

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();

        $this->layout = false;

        return $this->render('cart', compact('session'));
    }

    //============================================================

    public function actionOrder()
    {
        $session = Yii::$app->session;
        $session->open();

        $this->setMeta('Оформление заказа');

        $model_order = new Orders();

        if ($model_order->load(Yii::$app->request->post()))
        {
            $model_order->qty = $session['cart.qty'];
            $model_order->sum = $session['cart.sum'];

            if ($model_order->save())
            {
                OrderItems::saveOrder($session['cart'], $model_order->id);

                Yii::$app->session->setFlash('success', 'Ваш заказ принят.');

                Yii::$app->mailer
                    ->compose('order', compact('session'))
                    ->setFrom(['kbelyi@list.ru' => 'E-Shop.com'])
                    ->setTo($model_order->email)
                    ->setSubject('Заказ')
                    ->send();

                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа.');
            }
        }

        return $this->render('order', compact('model_order', 'session'));
    }
}