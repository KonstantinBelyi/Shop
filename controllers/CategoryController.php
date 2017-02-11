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
use yii\data\Pagination;

class CategoryController extends AppController
{
    private $limit_popular_products = 6;
    private $page_size = 3;

    //============================================================

    public function actionIndex()
    {
        $hit = Product::find()
            ->where(['hit' => '1'])
            ->limit($this->limit_popular_products)
            ->all();

        $this->setMeta("SHOP");

        return $this->render('index', compact('hit'));
    }

    //============================================================

    public function actionView()
    {
        $id = Yii::$app->request->get('id');

        $query = Product::find()
            ->where(['category_id' => $id]);

        $pagination = new Pagination([
            'defaultPageSize' => $this->page_size,
            'totalCount' => $query->count(),
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);

        $products = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        //$category = Category::findOne($id);
        $category = Category::getConcatenationParentAndCategory($id);

        if (is_array($category))
            $category = (object)$category;

        $this->setMeta('SHOP | ' . $category->name , $category->keywords, $category->description);


        return $this->render('view', compact('products', 'pagination', 'category'));
    }

    //============================================================
}