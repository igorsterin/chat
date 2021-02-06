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
        // 'tableOptions' => ['style' => 'width:2000px'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Логин',
                'attribute' => 'username',
                'contentOptions' => ['style' => 'width:300px; '],
            ],
            [
                'label' => 'Роль',
                'attribute' => 'is_admin',
                'value' => function ($data) {
                    $role = $data->is_admin == 1 ? 'Администратор' : 'Пользователь';
                    return $role;
                },
                'contentOptions' => ['style' => 'width:300px; '],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                // вы можете настроить дополнительные свойства здесь.
                'template' => '{1}',
                'buttons' => [
                    '1' => function ($url, $model, $key) {
                        $url = Url::toRoute(['chat/change-role', 'id' => $model->id, 'newRole' => !$model->is_admin]);
                        $option = ['data-confirm' => 'Вы уверены, что хотите изменить роль пользователя?'];
                        return $model->is_admin == 1 ? Html::a('Разжаловать администратора', $url, $option) : Html::a(
                            'Назначить администратором',
                            $url,
                            $option
                        );
                    },
                ],
                'contentOptions' => ['style' => 'width:300px; '],
            ],

        ]
    ]
);
?>