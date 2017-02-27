<?php

/* @var $model_order app\models\Orders */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="container">

    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Сумма</th>
    <!--                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>-->
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= Html::img("@web/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 70]) ?></td>
                        <td><a href="<?= Url::to(['product/view', 'id' => $id])?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty'] * $item['price'] ?></td>
<!--                        <td><span data-id = "--><?//= $id?><!--" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>-->
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td colspan="4">Всего товаров: </td>
                    <td><?= $session['cart.qty']; ?></td>
                </tr>

                <tr>
                    <td colspan="4">На сумму: </td>
                    <td><?= $session['cart.sum']; ?></td>
                </tr>

                </tbody>
            </table>
        </div>
        <hr/>

        <div class="container">
            <div class="col-xs-4 col-xs-offset-4">

                <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model_order, 'name')?>
                <?= $form->field($model_order, 'email')?>
                <?= $form->field($model_order, 'phone')?>
                <?= $form->field($model_order, 'address')?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary'] )?>
                </div>

                <div style="color:#999;margin:1em 0">
                    <i>*На указанный E-mail будет отправлено письмо с номером заказа.</i>
                </div>

                <?php ActiveForm::end() ?>
            </div>

        </div>


    <?php else: ?>
        <h3>Корзина пуста!</h3>
    <?php endif; ?>
</div>
