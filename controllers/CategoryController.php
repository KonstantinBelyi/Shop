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

        $this->setMeta("SHOP");

        return $this->render('index', compact('hit'));
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $products = Product::findCategoryId($id);
        $category = Category::getConcatenationParentAndCategory($id);

        if (is_array($category))
            $category = (object)$category;

        $this->setMeta('SHOP | ' . $category->name , $category->keywords, $category->description);


        return $this->render('view', compact('products', 'category'));
    }
}