<?php
/** @var app\models\Chat $newMessage */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>


<?=
$form->field($newMessage, 'message')
    ->textarea(['placeholder' => 'Ваше сообщение', 'style' => 'margin-top: 0px; margin-bottom: 0px; height: 200px; width: 600px'])
    ->label(false) ?>


<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>

<?php
ActiveForm::end(); ?>
