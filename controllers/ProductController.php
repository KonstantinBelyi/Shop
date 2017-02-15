<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 11.02.2017
 * Time: 23:41
 */

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        $product = Product::findOne($id);

        if (empty($product))
            throw new HttpException(404, 'Товар не найден!');

        $this->setMeta('SHOP | ' . $product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product'));
    }
}