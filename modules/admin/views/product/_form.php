<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MenuCategoryWidget;
use mihaildev\ckeditor\CKEditor;

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
        echo $form->field($model, 'content')->widget(CKEditor::className(),[
            'editorOptions' => [
                'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]);
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

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
