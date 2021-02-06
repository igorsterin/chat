<?php


namespace app\controllers;


use app\models\Chat;
use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;

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
        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionChat()
    {
        $messages = Chat::find()->select(['id', 'message', 'date_pub', 'author', 'incorrect'])->all();
        $count = Chat::find()->count();
        $countCorrect = Chat::find()
            ->where(['incorrect' => 0])
            ->count();

        $newMessage = new Chat();

        if ($newMessage->load(Yii::$app->request->post())) {
            // данные в $model удачно проверены
            $newMessage->author = Yii::$app->user->identity->username;
            $newMessage->save();

            return $this->refresh();
        } else {
            return $this->render('chat',
                                 [
                                     'newMessage' => $newMessage,
                                     'messages' => $messages,
                                     'count' => $count,
                                     'countCorrect' => $countCorrect
                                 ]
            );
        }
    }

    public function actionChangeVisible($id, $incorrect)
    {
        $hideMessage = Chat::findOne($id);
        $hideMessage->incorrect = $incorrect;
        $hideMessage->save();
        return $incorrect ?
            $this->goHome() : $this->redirect(['chat/incorrect-messages']);
    }

    public function actionUsersTable()
    {
        if (Yii::$app->user->identity->is_admin) {
            $dataProvider = new ActiveDataProvider(
                [
                    'query' => User::find()
                ]
            );
            return $this->render('usersTable', ['dataProvider' => $dataProvider]);
        } else {
            return $this->goHome();
        }
    }

    public function actionChangeRole($id, $newRole)
    {
        $user = User::findOne($id);
        $user->is_admin = $newRole;
        $user->save();
        return $this->redirect(['chat/users-table']);
    }

    public function actionIncorrectMessages()
    {
        if (Yii::$app->user->identity->is_admin) {
            $dataProvider = new ActiveDataProvider(
                [
                    'query' => Chat::find()
                        ->where(['incorrect' => 1])
                ]
            );
            return $this->render('incorrectMessages', ['dataProvider' => $dataProvider]);
        } else {
            return $this->goHome();
        }
    }

}