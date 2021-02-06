<?php
/**
 * @var ActiveDataProvider $dataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Сообщение',
                'attribute' => 'message',
            ],
            [
                'label' => 'Дата публикации',
                'attribute' => 'date_pub',
                'format' => ['date', 'php:d.m.Y в H:i'],
                'contentOptions' => ['style' => 'width:150px; '],
            ],
            [
                'label' => 'Автор',
                'attribute' => 'author',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                // вы можете настроить дополнительные свойства здесь.
                'template' => '{1}',
                'buttons' => [
                    '1' => function ($url, $model, $key) {
                        $url = Url::toRoute(['chat/change-visible', 'id' => $model->id, 'incorrect' => 0]);
                        $option = ['data-confirm' => 'Вы уверены, что хотите сделать сообщение видимым?'];
                        return Html::a('Восстановить сообщение', $url, $option);
                    },
                ],
                'contentOptions' => ['style' => 'width:190px; '],
            ],
        ]
    ]
)
?>
