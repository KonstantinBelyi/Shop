<?php

/* @var $this yii\web\View
 * @var $product app\controllers\ProductController
 * @var $pagination app\controllers\CategoryController
 */

use yii\helpers\Html;
use yii\helpers\Url;
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

            <?php
                $mainImg = $product->getImage();
                $gallery = $product->getImages();
            ?>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">

                            <div class="view-product">

                                <?= Html::img($mainImg->getUrl(), ['alt' => $product->name]) ?>

                            </div>

                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">

                                    <?php
                                    $count = count($gallery);
                                    $i = 0;
                                    foreach ($gallery as $img): ?>

                                        <?php if ($i % 3 == 0): ?>
                                            <div class="item <?php if ($i == 0) echo ' active' ?>">
                                        <?php endif; ?>

                                            <a href=""><?= Html::img($img->getUrl('84x85'), ['alt' => '']) ?></a>

                                        <?php $i++; if ($i % 3 == 0 || $i == $count): ?>
                                            </div>
                                        <?php endif; ?>

                                    <?php endforeach; ?>

                                </div>

                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>


                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->

                                <h2><?= $product->name; ?></h2>
                                <p>Код товара: 1089772</p>
                                <span>
                                    <span>$<?= $product->price; ?></span>
                                    <label for="qty">Количество:</label>
                                    <input type="text" value="1" id="qty" />
                                    <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>" data-id = "<?= $product->id; ?>"
                                       class="btn btn-fefault add-to-cart cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        В корзину
                                    </a>
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