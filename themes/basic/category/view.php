<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\components\MenuCategoryWidget;

$this->title = 'Shop';
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Категории</h2>

                    <ul class="catalog category-products">
                        <?= MenuCategoryWidget::widget(['template' => 'menu'])?>
                    </ul>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>

                        <?php if (!empty($category_id)): ?>

                            <?php /*$i = 0;*/ foreach ($category_id as $value): ?>

                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <?= Html::img("@web/images/products/{$value->img}", ['alt' => $value->name]) ?>

                                                <h2>$<?= $value->price; ?></h2>

                                                <p><?= $value->name; ?></p>

                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                            </div>

                                            <?php if ($value->new):?>
                                                <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                                            <?php endif;?>

                                            <?php if ($value->sale):?>
                                                <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']) ?>
                                            <?php endif;?>

                                        </div>
                                    </div>
                                </div>

<!--                                --><?php //$i++;?>
<!--                                --><?php //if ($i % 3 ==0): ?>
<!--                                   <div class="clearfix"></div>-->
<!--                                --><?php //endif; ?>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <h3>Нет товара</h3>

                        <?php endif; ?>
                    <div class="clearfix"></div>
                    <ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>
                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>
