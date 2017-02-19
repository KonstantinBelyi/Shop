<?php

/* @var $session app\controllers\CartController */

?>

<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #DDDDDD; border-collapse: collapse;">
        <thead>
        <tr style="background: #f9f9f9">
            <th style="padding: 8px; border: 1px solid #DDDDDD">Наименование</th>
            <th style="padding: 8px; border: 1px solid #DDDDDD">Количество</th>
            <th style="padding: 8px; border: 1px solid #DDDDDD">Цена</th>
            <th style="padding: 8px; border: 1px solid #DDDDDD">Сумма</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($session['cart'] as $id => $item): ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #DDDDDD"><?= $item['name'] ?></td>
                <td style="padding: 8px; border: 1px solid #DDDDDD"><?= $item['qty'] ?></td>
                <td style="padding: 8px; border: 1px solid #DDDDDD"><?= $item['price'] ?></td>
                <td style="padding: 8px; border: 1px solid #DDDDDD"><?= $item['qty'] * $item['price'] ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="3" style="padding: 8px; border: 1px solid #DDDDDD">Всего товаров: </td>
            <td style="padding: 8px; border: 1px solid #DDDDDD"><?= $session['cart.qty']; ?></td>
        </tr>

        <tr>
            <td colspan="3" style="padding: 8px; border: 1px solid #DDDDDD">На сумму: </td>
            <td style="padding: 8px; border: 1px solid #DDDDDD"><?= $session['cart.sum']; ?></td>
        </tr>

        </tbody>
    </table>
</div>