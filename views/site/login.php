<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model_login app\models\Login */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>
<div class="container">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>

            <?php echo Yii::$app->session->getFlash('success'); ?>

        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
            </button>

            <?php echo Yii::$app->session->getFlash('error'); ?>

        </div>
    <?php endif; ?>

    <div class="text-center">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="col-xs-4 col-xs-offset-4">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model_login, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model_login, 'password')->passwordInput() ?>

        <?= $form->field($model_login, 'rememberMe')->checkbox() ?>

        <div style="color:#999;margin:1em 0">
            Забыли пароль? Вы можете <?= Html::a('восстановить его', ['reset/request-password-reset']) ?>.
        </div>

        <div class="form-group text-center">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
