<?php
/**
 * @var $message string
 * @var $datePub string
 * @var $author string
 */

use app\models\User;
use yii\helpers\Html;

$flag1 = 'else-message-body';
$flag2 = 'else-message-details';
$flag4 = '';
$note = '';

if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->username == $author) {
        $flag1 = 'my-message';
        $flag2 = '';
    }
}

if ((User::findByUsername($author))->is_admin) {
    $flag4 =  ' admin-border';
    $note = '(Администратор)';
}

?>

<?= Html::beginTag('div', ['class' => 'message-body ' . $flag1 . $flag4]) ?>

<?= nl2br($message) ?>

<?= Html::endTag('div') ?>

<?= Html::beginTag('div', ['class' => 'message-details ' . $flag2]) ?>

<?= $author.$note;
Yii::$app->formatter->locale = 'ru-RU';
echo Yii::$app->formatter->asDate($datePub, ', j MMMM Y в H:i');
 ?>

<?= Html::endTag('div') ?>
