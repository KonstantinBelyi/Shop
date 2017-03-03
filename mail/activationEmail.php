<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$activationLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate-account', 'key' => $user->password_reset_token]);
?>
<div class="container">
    <p>Здравствуйте <?= Html::encode($user->username) ?>,</p>

    <p><?= Html::a('Перейдите по этой ссылке, чтобы активировать аккаунт', $activationLink) ?></p>
</div>