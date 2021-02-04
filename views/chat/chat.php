<?php

/** @var app\models\Chat $newMessage */
/** @var app\models\Chat $messages */
/** @var int $count */

$css = <<<CSS
.else-message-body {
margin-left: 80px;
}
.else-message-details {
text-align: right;
}
.my-message {
margin-right: 80px;
}
.message-details {
    color: #999;
    font-size: 12px;
    vertical-align: top;
    padding-top: 7px;
    padding-bottom: 14px;
}
.chat-content {
width: 680px;
}
.message-body {
    word-wrap: break-word;
    padding: 13px 35px 15px 15px;
    box-sizing: border-box;
    background: #fafafa;
}
CSS;

$this->registerCss($css);

?>

    <div class="chat-content">

<?php

for ($i=0; $i<$count; $i++) {
    $message = $messages[$i]['message'];
    $datePub = $messages[$i]['date_pub'];
    $author = $messages[$i]['author'];

    echo $this->render('message', ['message' => $message, 'datePub' => $datePub, 'author' => $author]);
} ?>

<?php
 if (!Yii::$app->user->isGuest) {
     echo $this->render('newMessage', ['newMessage' => $newMessage]);
 } else {
     echo 'Для отправки сообщений необходима авторизация';
 }
 /*!Стили для сообщения выше!
    color: #999;
    margin-top: 30px;
    margin-left: 190px;
    margin-bottom: 30px;
  */
?>

    </div>
