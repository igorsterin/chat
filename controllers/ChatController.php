<?php


namespace app\controllers;


use app\models\Chat;
use app\models\LoginForm;
use app\models\User;
use Yii;

class ChatController extends \yii\web\Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionChat()
    {
        $messages = Chat::find()->select(['id', 'message', 'date_pub', 'author'])->all();
        $count = Chat::find()->count();

        $newMessage = new Chat();

        if ($newMessage->load(Yii::$app->request->post())) {
            // данные в $model удачно проверены
            $newMessage->author = Yii::$app->user->identity->username;
            $newMessage->save();

            return $this->refresh();
        } else {
            return $this->render('chat', ['newMessage' => $newMessage, 'messages' => $messages, 'count' => $count]);
        }
    }
}