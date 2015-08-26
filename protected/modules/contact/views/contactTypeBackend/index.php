<?php
$this->breadcrumbs = [
    Yii::t($this->aliasModule, 'Contact types') => [$this->patchBackend.'index'],
    Yii::t($this->aliasModule, 'List'),
];

$this->pageTitle = Yii::t($this->aliasModule, 'List contact types');

$this->menu = [
    [
        'label' => Yii::t($this->aliasModule, 'Contacts'),
        'items' => [
            [
                'icon' => 'list-alt',
                'label' => Yii::t($this->aliasModule, 'List contacts'),
                'url' => ['/contact/contactBackend/index']
            ],
        ]
    ],
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
    ]
]; ?>

<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Contact types'); ?>
        <small><?= Yii::t($this->aliasModule, 'list'); ?></small>
    </h1>
</div>

    <p><?= Yii::t($this->aliasModule, 'Types management'); ?></p>

<?php $this->widget('yupe\widgets\CustomGridView', [
    'id'           => 'contactType-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'sortField'    => 'name',
    'columns'      => [
        'name',
        [
            'name'   => 'validation',
            'value'  => '$data->getTitleValidation()',
            'filter' => CHtml::activeDropDownList(
                $model,
                'validation',
                $model->getListValidates(),
                ['class' => 'form-control', 'encode' => false, 'empty' => '']
            ),
        ],
        [
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{update}{delete}',
        ],
    ],
]); ?>