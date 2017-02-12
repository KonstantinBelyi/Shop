<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\components\MenuCategoryWidget;
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
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">

                                <?= Html::img("@web/images/products/{$product->img}", ['alt' => $product->name]) ?>

                            </div>

                            <?php if ($product->new):?>
                                <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                            <?php endif;?>

                            <?php if ($product->sale):?>
                                <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']) ?>
                            <?php endif;?>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->

                                <h2><?= $product->name; ?></h2>
                                <p>Код товара: 1089772</p>
                                <span>
                                    <span>$<?= $product->price; ?></span>
                                    <label>Количество:</label>
                                    <input type="text" value="1" />
                                    <button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        В корзину
                                    </button>
                                </span>
                                <p><b>Наличие:</b>
                                    <?php
                                        if ($product->exist)
                                            echo ' На складе';
                                        else
                                            echo ' Отсутствует';
                                    ?>
                                </p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> D&amp;G</p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>

                            <?= $product->content; ?>

                        </div>
                    </div>
                </div><!--/product-details-->
            </div>
        </div>
    </div>
</section>