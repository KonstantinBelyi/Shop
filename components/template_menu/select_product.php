<?php
/* @var $this app\components\MenuCategoryWidget */
/* @var $category array */
/* @var $tab string */
?>

    <option value="<?= $category['id']?>"
        <?php
            if ($category['id'] == $this->model->category_id) echo 'selected';
        ?>

        <?php
            if( isset($category['childs'])) echo 'disabled';
        ?>

    ><?= $tab . $category['name']?></option>
    <?php if( isset($category['childs']) ): ?>
        <ul>
            <?= $this->getMenuHtml($category['childs'], $tab . '---') ?>
        </ul>
    <?php endif;?>