<?php

/** @var app\models\Chat $newMessage */

/** @var app\models\Chat $messages */

/** @var int $count */

/** @var int $countCorrect */

use yii\helpers\Html;

$this->registerCssFile('@web/css/custom.css');
$flag3 = '';

if ($countCorrect == 0) {
    $flag3 = 'empty-border';
}

?>

<div class="chat-content">

    <?= Html::beginTag('div', ['class' => 'messages ' . $flag3]) ?>

    <?php
    if ($countCorrect == 0): ?>

        <p class="empty-msg">
            Здесь будет выводиться история чата</p>

    <?php
    else:

        for ($i = 0; $i < $count; $i++) {
            $message = $messages[$i]['message'];
            $datePub = $messages[$i]['date_pub'];
            $author = $messages[$i]['author'];
            $incorrect = $messages[$i]['incorrect'];

            if (!$incorrect) {
                echo $this->render(
                    'message',
                    ['message' => $message, 'datePub' => $datePub, 'author' => $author, 'i' => $i + 1]
                );
            }
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
