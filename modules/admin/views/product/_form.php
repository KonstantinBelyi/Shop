<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MenuCategoryWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-product-category_id">
        <label class="control-label" for="product-category_id">Категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">

            <?= MenuCategoryWidget::widget(['template' => 'select_product', 'model' => $model])?>

        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hit')->checkbox(['0', '1'], false) ?>

    <?= $form->field($model, 'recommend')->checkbox([ '0', '1', ], false) ?>

    <?= $form->field($model, 'new')->checkbox([ '0', '1', ], false) ?>

    <?= $form->field($model, 'sale')->checkbox([ '0', '1', ], false) ?>

    <?= $form->field($model, 'exist')->checkbox([ '0', '1', ], false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>