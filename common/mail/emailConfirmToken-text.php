<?php

/* @var $this yii\web\View */
/* @var $user \common\entities\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['client/confirm-email', 'token' => $user->email_confirm_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to confirm your email:

<?= $resetLink ?>
