<?php
$this->breadcrumbs = [
    Yii::t($this->aliasModule, 'Contacts') => [$this->patchBackend.'index'],
    Yii::t($this->aliasModule, 'List'),
];

$this->pageTitle = Yii::t($this->aliasModule, 'List contacts');

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
        'label' => Yii::t($this->aliasModule, 'Contact types'),
        'items' => [
            [
                'icon' => 'list-alt',
                'label' => Yii::t($this->aliasModule, 'List types'),
                'url' => ['/contact/contactTypeBackend/index']
            ],
        ]
    ],
];
?>

<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Contacts'); ?>
        <small><?= Yii::t($this->aliasModule, 'list'); ?></small>
    </h1>
</div>

    <p><?= Yii::t($this->aliasModule, 'Contact management'); ?></p>

<?php $this->widget('yupe\widgets\CustomGridView', [
    'id'           => 'contact-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'sortField'    => 'type_id',
    'columns'      => [
        [
            'name'   => 'type_id',
            'value'  => '$data->contactType->name',
            'filter' => CHtml::activeDropDownList(
                $model,
                'type_id',
                ContactType::model()->getListNameType(),
                ['class' => 'form-control', 'encode' => false, 'empty' => '']
            ),
        ],
        'name',
        [
            'name'   => 'category_id',
            'value'  => '$data->getCategoryName()',
            'filter' => CHtml::activeDropDownList(
                $model,
                'category_id',
                Category::model()->getFormattedList(Yii::app()->getModule('contact')->mainCategory),
                ['class' => 'form-control', 'encode' => false, 'empty' => '']
            )
        ],
        [
            'name'   => 'data',
            'value'  => '$data->data',
            'type'   => 'raw'
        ],
        [
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{update}{delete}',
        ],
    ],
]); ?>