<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['reset/reset-password', 'key' => $user->password_secret_key]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($user->username) ?>,</p>

    <p><?= Html::a('Перейдите по этой ссылке, чтобы сбросить пароль', $resetLink) ?></p>
</div>
