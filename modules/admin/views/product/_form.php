<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MenuCategoryWidget;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group field-product-category_id">
        <label class="control-label" for="product-category_id">Категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">

            <?= MenuCategoryWidget::widget(['template' => 'select_product', 'model' => $model])?>

        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
         echo $form->field($model, 'content')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
         ]);
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div style="color:#999;">
        <i>*Можно загрузить форматы только png и jpg.</i>
    </div>

    <?php
        $mainImg = $model->getImage();
        $galleryImg = $model->getImages();
    ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="container" style="margin: 15px 0">

        <?= Html::img($mainImg->getUrl('100x100'), ['alt' => '']) ?>

    </div>

    <?= Html::a('Удалить основное фото', ['remove', 'id' => $model->id], [
        'class' => 'btn btn-xs btn-danger',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить основное фото?',
            'method' => 'post',
        ],
    ]) ?>

    <div style="color:#999;">
        <i>*Максимальное количество 4 фото.</i>
    </div>

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="container" style="margin: 15px 0">
        <?php foreach ($galleryImg as $img): ?>

            <?= Html::img($img->getUrl('100x100'), ['alt' => '']) ?>

        <?php endforeach; ?>
    </div>

    <?= Html::a('Удалить все фотографии', ['remove-gallery', 'id' => $model->id], [
        'class' => 'btn btn-xs btn-danger',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить ВСЕ фотографии?',
            'method' => 'post',
        ],
    ]) ?>

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
