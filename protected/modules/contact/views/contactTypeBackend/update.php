<?php
    $this->breadcrumbs = [
        Yii::t($this->aliasModule, 'Contact types') => [$this->patchBackend.'index'],
        $model->name => [$this->patchBackend.'view', 'id' => $model->id],
        Yii::t($this->aliasModule, 'Editing'),
    ];

    $this->pageTitle = Yii::t($this->aliasModule, 'Types contacts - editing');

    $this->menu = [
        [
            'label' => Yii::t($this->aliasModule, 'Contact types'),
            'items' => [
                [
                    'icon' => 'list-alt',
                    'label' => Yii::t($this->aliasModule, 'List types'),
                    'url' => [$this->patchBackend.'index']
                ],
                [
                    'icon' => 'plus-sign',
                    'label' => Yii::t($this->aliasModule, 'Add type'),
                    'url' => [$this->patchBackend.'create']
                ],
            ]
        ],
        [
            'label' => Yii::t($this->aliasModule, 'Type') . ' «' . mb_substr($model->name, 0, 32) . '»'
        ],
        [
            'icon' => 'trash',
            'label' => Yii::t($this->aliasModule, 'Delete type'),
            'url' => '#', 'linkOptions' => [
                'submit' => [
                    $this->patchBackend.'delete',
                    'id' => $model->id
                ],
                'params' => [
                    Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken
                ],
                'confirm' => Yii::t($this->aliasModule, 'Do you really want to remove the type?'),
                'csrf' => true,
            ]
        ],
    ];
?>
<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Editing type'); ?><br />
        <small>&laquo;<?= $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php
    $this->renderPartial('_form', [
        'model'=>$model,
    ]);