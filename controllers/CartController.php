<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Cart;

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

    public function actionView()
    {
        return $this->render('view');
    }
}