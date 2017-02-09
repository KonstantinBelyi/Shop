<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 09.02.2017
 * Time: 21:19
 */

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;

class CategoryController extends AppController
{
    private $limitLastProducts = 6;

    public function actionIndex()
    {
        $lastProduct = Product::lastProducts($this->limitLastProducts);

        return $this->render('index', compact('lastProduct'));
    }
}