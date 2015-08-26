<?php
    $this->breadcrumbs = [
        Yii::t($this->aliasModuleT, 'Типы контактов') => [$this->patchBackend.'index'],
        $model->name => [$this->patchBackend.'view', 'id' => $model->id],
        Yii::t($this->aliasModuleT, 'Редактирование'),
    ];

    $this->pageTitle = Yii::t($this->aliasModuleT, 'Типы контактов - редактирование');

    $this->menu = [
        ['icon' => 'list-alt', 'label' => Yii::t($this->aliasModuleT, 'Список типов'),
            'url' => [$this->patchBackend.'index']
        ],
        ['icon' => 'plus-sign', 'label' => Yii::t($this->aliasModuleT, 'Добавить тип'),
            'url' => [$this->patchBackend.'create']
        ],
        ['label' => Yii::t('ContactModule.contacty', 'Тип') . ' «' . mb_substr($model->name, 0, 32) . '»'],
        ['icon' => 'trash', 'label' => Yii::t($this->aliasModuleT, 'Удалить тип'),
            'url' => '#', 'linkOptions' => [
                'submit' => [$this->patchBackend.'delete', 'id' => $model->id],
                'params' => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
                'confirm' => Yii::t($this->aliasModuleT, 'Вы действительно хотите удалить тип?'),
                'csrf' => true,
            ]
        ],
    ];
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModuleT, 'Редактирование типа контакта'); ?><br />
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php
    $this->renderPartial('_form', [
        'model'=>$model,
    ]);