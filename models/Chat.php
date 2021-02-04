<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\base\Model;

class Chat extends ActiveRecord
{

 public function rules()
 {
     return [
         [['message'], 'required', 'message' => 'Отправка пустых сообщений запрещена'],
     ];
 }
}