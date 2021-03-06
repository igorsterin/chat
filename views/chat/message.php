<?php
/**
 * @var $message string
 * @var $datePub string
 * @var $author string
 * @var $i int
 */

use app\models\User;
use yii\helpers\Url;
use yii\helpers\Html;

$flag1 = 'else-message-body';
$flag2 = 'else-message-details';
$flag4 = '';
$flag5 = 'hide-href';
$note = '';

if (!Yii::$app->user->isGuest && Yii::$app->user->identity->username == $author) {
    $flag1 = 'my-message';
    $flag2 = '';
    $flag5 = '';
}

if ((User::findByUsername($author))->is_admin) {
    $flag4 = ' admin-border';
    $note = '(Администратор)';
}

$url = Url::toRoute(['chat/change-visible', 'id' => $i, 'incorrect' => 1]);
$options = [
    'class' => 'message-details ' . $flag5,
    'data-confirm' => 'Вы уверены, что хотите скрыть сообщение?'
];

?>

<?=
!Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin ?
    Html::a('Скрыть сообщение', $url, $options) : '';
?>

<?= Html::beginTag('div', ['class' => 'message-body ' . $flag1 . $flag4]) ?>

<?= nl2br($message) ?>

<?= Html::endTag('div') ?>

<?= Html::beginTag('div', ['class' => 'message-details ' . $flag2]) ?>

<?= $author . $note;
Yii::$app->formatter->locale = 'ru-RU';
echo Yii::$app->formatter->asDatetime($datePub, ', j MMMM Y в H:i');
?>

<?= Html::endTag('div') ?>
