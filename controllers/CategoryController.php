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
use yii\web\HttpException;

class CategoryController extends AppController
{
    private $limit_popular_products = 6;
    private $limit_recommend_products = 6;
    private $pagination_page_size = 3;

    //============================================================

    public function actionIndex()
    {
        $hit = Product::find()
            ->where(['hit' => '1',])
            ->limit($this->limit_popular_products)
            ->all();

        $recommend = Product::find()
            ->where(['recommend' => '1',])
            ->limit($this->limit_recommend_products)
            ->all();


        $this->setMeta("SHOP");

        return $this->render('index', compact('hit', 'recommend'));
    }

    //============================================================

    public function actionView()
    {
        $id = Yii::$app->request->get('id');

        //$category = Category::findOne($id);
        $category = Category::getConcatenationParentAndCategory($id);

        if (empty($category))
            throw new HttpException(404, 'Категория не найдена!');

        $query = Product::find()
            ->where(['category_id' => $id,]);

        $pagination = new Pagination([
            'defaultPageSize' => $this->pagination_page_size,
            'totalCount' => $query->count(),
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);

        $products = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        if (is_array($category))
            $category = (object)$category;

        $this->setMeta('SHOP | ' . $category->name , $category->keywords, $category->description);


        return $this->render('view', compact('products', 'pagination', 'category'));
    }

    //============================================================
}