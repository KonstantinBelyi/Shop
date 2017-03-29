<?php

/* @var $this yii\web\View
 * @var $hit app\controllers\CategoryController
 * @var $recommend app\controllers\CategoryController
 */

use yii\helpers\Html;
use yii\helpers\Url;
use \app\components\MenuCategoryWidget;
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
                    <h2 class="title text-center">Популярные товары</h2>

                        <?php $i = 0; foreach ($hit as $value):?>

                            <?php
                                $hitImg = $value->getImage();
                            ?>

                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">

                                            <?= Html::img($hitImg->getUrl('255x255'), ['alt' => $value->name]) ?>

                                            <h2><?= $value->price; ?>$</h2>

                                            <p><a href="<?= Url::to(['product/view', 'id' => $value->id])?>" ><?= $value->name; ?></a></p>

                                            <a href="<?= Url::to(['cart/add', 'id' => $value->id])?>" data-id = "<?= $value->id; ?>"
                                               class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </a>
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

                            <?php $i++;?>
                            <?php if ($i % 3 == 0): ?>
                               <div class="clearfix"></div>
                            <?php endif; ?>

                        <?php endforeach;?>
                </div><!--features_items-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            <?php
                                $count = count($recommend);
                                $i = 0;
                                foreach ($recommend as $value): ?>

                                <?php
                                    $recommendImg = $value->getImage();
                                ?>

                                <?php if ($i % 3 == 0): ?>
                                    <div class="item <?php if ($i == 0) echo 'active' ?>">
                                <?php endif; ?>

                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">

                                                    <?= Html::img($recommendImg->getUrl('255x255'), ['alt' => $value->name]) ?>

                                                    <h2><?= $value->price; ?>$</h2>

                                                    <p><a href="<?= Url::to(['product/view', 'id' => $value->id])?>" ><?= $value->name; ?></a></p>

                                                    <a href="<?= Url::to(['cart/add', 'id' => $value->id])?>" data-id = "<?= $value->id; ?>"
                                                       class="btn btn-default add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        В корзину
                                                    </a>
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

                                <?php $i++; if ($i % 3 == 0 || $i == $count): ?>
                                    </div>
                                <?php endif; ?>

                            <?php endforeach; ?>

                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>
