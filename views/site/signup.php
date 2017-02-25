<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model_signup app\models\Signup */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
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
        <?php $form = ActiveForm::begin(['id' => 'form-horizontal']); ?>

        <?= $form->field($model_signup, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model_signup, 'email') ?>

        <?= $form->field($model_signup, 'password')->passwordInput() ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <i>*На указанный E-mail будет отправлено письмо для активации аккаунта.</i>

        <?php ActiveForm::end(); ?>
    </div>

</div>