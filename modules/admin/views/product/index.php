<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'category_id',
            [
                'attribute' => 'category_id',
                'value' => function ($data){
                    return $data->category->name;
                },
            ],
            'name',
            //'content:ntext',
            'price',
            // 'keywords',
            // 'description',
            // 'img',
            // 'hit',
            [
                'attribute' => 'hit',
                'value' => function($data){
                    return !$data->hit ?
                        '<span class="text-danger">Нет</span>'
                        :
                        '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
            // 'recommend',
            [
                'attribute' => 'recommend',
                'value' => function($data){
                    return !$data->recommend ?
                        '<span class="text-danger">Нет</span>'
                        :
                        '<span class="text-success">ДА</span>';
                },
                'format' => 'html',
            ],
            // 'new',
            [
                'attribute' => 'new',
                'value' => function($data){
                    return !$data->new ?
                        '<span class="text-danger">Нет</span>'
                        :
                        '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
            // 'sale',
            [
                'attribute' => 'sale',
                'value' => function($data){
                    return !$data->sale ?
                        '<span class="text-danger">Нет</span>'
                        :
                        '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
            //'exist',
            [
                'attribute' => 'exist',
                'value' => function($data){
                    return !$data->exist ?
                        '<span class="text-danger">Нет</span>'
                        :
                        '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
