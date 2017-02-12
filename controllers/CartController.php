<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Cart;

class CartController extends AppController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');

        $product = Product::findOne($id);
        if (empty($product))
            return false;

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product);
    }
}