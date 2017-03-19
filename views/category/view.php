<?php

/* @var $this yii\web\View
 * @var $category app\controllers\CategoryController
 * @var $pagination app\controllers\CategoryController
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MenuCategoryWidget;
use yii\widgets\LinkPager;
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
                    <h2 class="title text-center"><?= $category->name; ?></h2>

                        <?php if (!empty($products)): ?>

                            <?php /*$i = 0;*/ foreach ($products as $value): ?>

                                <?php
                                    $productsImg = $value->getImage();
                                ?>

                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">

                                                <?= Html::img($productsImg->getUrl(), ['alt' => $value->name]) ?>

                                                <h2>$<?= $value->price; ?></h2>

                                                <p><a href="<?= Url::to(['product/view', 'id' => $value->id])?>" ><?= $value->name; ?></a></p>

                                                <a href="#" data-id = "<?= $value->id; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>

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

                            <div class="clearfix"></div>

                            <?php
                            echo LinkPager::widget([
                            'pagination' => $pagination,
                            ]);
                            ?>

                        <?php else: ?>

                            <h3>Нет товара</h3>

                        <?php endif; ?>
                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>
