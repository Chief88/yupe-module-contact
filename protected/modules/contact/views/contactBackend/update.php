<?php
    $this->breadcrumbs = [
        Yii::t($this->aliasModule, 'Contacts') => [$this->patchBackend.'index'],
        $model->id => [$this->patchBackend.'view', 'id' => $model->id],
        Yii::t($this->aliasModule, 'Editing'),
    ];

    $this->pageTitle = Yii::t($this->aliasModule, 'Contacts - editing');

    $this->menu = [
        [
            'label' => Yii::t($this->aliasModule, 'Contacts'),
            'items' => [
                [
                    'icon' => 'list-alt',
                    'label' => Yii::t($this->aliasModule, 'List contacts'),
                    'url' => [$this->patchBackend.'index']
                ],
                [
                    'icon' => 'plus-sign',
                    'label' => Yii::t($this->aliasModule, 'Add contact'),
                    'url' => [$this->patchBackend.'create']
                ],
            ]

        ],
        [
            'label' => Yii::t($this->aliasModule, 'Contact') . ' «' . mb_substr($model->contactType->name . ' [' . $model->category->name . ']', 0, 32) . '»'
        ],
        [
            'icon' => 'trash',
            'label' => Yii::t($this->aliasModule, 'Delete contact'),
            'url' => '#', 'linkOptions' => [
                'submit' => [
                    $this->patchBackend.'delete',
                    'id' => $model->id
                ],
                'params' => [
                    Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken
                ],
                'confirm' => Yii::t($this->aliasModule, 'Do you really want to remove the contact?'),
                'csrf' => true,
            ]
        ],
    ];
?>
<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Contact editing'); ?><br />
        <small>&laquo;<?= $model->contactType->name . ' [' . $model->category->name . ']'; ?>&raquo;</small>
    </h1>
</div>

<?php
    $this->renderPartial('_form', [
        'model'=>$model,
    ]);