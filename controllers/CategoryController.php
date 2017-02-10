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
    private $limit_popular_products = 6;

    public function actionIndex()
    {
        $hit = Product::popularProducts($this->limit_popular_products);

        return $this->render('index', compact('hit'));
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $category_id = Product::findCategoryId($id);

        return $this->render('view', compact('category_id'));
    }
}