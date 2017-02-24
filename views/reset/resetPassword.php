<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model_reset app\models\ResetPassword */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
?>
<div class="container">

    <p class="text-center">Пожалуйста, введите новый пароль:</p>

    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?= $form->field($model_reset, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>