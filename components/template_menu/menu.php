<?php
/* @var $this app\components\MenuCategoryWidget */
/* @var $category array */

use yii\helpers\Url;
?>
<li>
    <a href="<?= Url::to(['category/view', 'id' => $category['id']])?>">
        <?= $category['name']; ?>
        <?php if ( isset($category['childs']) ): ?>
            <span class="badge pull-right"></span> <!--<i class="fa fa-plus"></i>-->
        <?php endif;?>
    </a>
    <?php if( isset($category['childs']) ): ?>
        <ul>
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
    <?php endif;?>
</li>

