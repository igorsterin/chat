<?php

/** @var app\models\Chat $newMessage */

/** @var app\models\Chat $messages */

/** @var int $count */

use yii\helpers\Html;

$this->registerCssFile('@web/css/custom.css');
$flag3 = '';
if ($count == 0) {
    $flag3 = 'empty-border';
}

?>

<div class="chat-content">

    <?= Html::beginTag('div', ['class' => 'messages ' . $flag3]) ?>

    <?php
    if ($count == 0): ?>

        <p class="empty-msg"
        ">Здесь будет выводиться история чата</p>

    <?php
    else:

        for ($i = 0; $i < $count; $i++) {
            $message = $messages[$i]['message'];
            $datePub = $messages[$i]['date_pub'];
            $author = $messages[$i]['author'];

            echo $this->render('message', ['message' => $message, 'datePub' => $datePub, 'author' => $author]);
        } ?>

    <?php
    endif; ?>

    <?= Html::endTag('div') ?>

    <?php
    if (!Yii::$app->user->isGuest): echo $this->render('newMessage', ['newMessage' => $newMessage]); ?>

    <?php
    else: ?>

        <div class="auth-msg">
            <?= 'Для отправки сообщений необходима авторизация' ?>
        </div>

    <?php
    endif; ?>


</div>
