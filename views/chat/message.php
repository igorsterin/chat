<?php
/**
 * @var $message string
 * @var $datePub string
 * @var $author string
 */

use yii\helpers\Html;
$flag1 = 'else-message-body';
$flag2 = 'else-message-details';

if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->username == $author) {
        $flag1 = 'my-message';
        $flag2 = '';
    }
}
?>

<?= Html::beginTag('div', ['class' => 'message-body ' . $flag1]) ?>

<?= nl2br($message) ?>

<?= Html::endTag('div') ?>

<?= Html::beginTag('div', ['class' => 'message-details ' . $flag2]) ?>

<?= $author . ' в ' . $datePub ?>

<?= Html::endTag('div') ?>
