<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model_request app\models\RequestPasswordReset */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
?>
<div class="container">

    <p class="text-center">
        Пожалуйста, введите вашу электронную почту. Ссылка для сброса пароля будет отправлена на ваш E-mail.
    </p>

    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model_request, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>