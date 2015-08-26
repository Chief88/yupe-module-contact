<?php
$this->breadcrumbs = [
    'Контакты' => [$this->patchBackend.'index'],
    'Список',
];

$this->pageTitle = 'Список контактов';

$this->menu = [
    [
        'label' => 'Контакты',
        'items' => [
            [
                'icon' => 'list-alt',
                'label' => 'Список контактов',
                'url' => [$this->patchBackend.'index']
            ],
            [
                'icon' => 'plus-sign',
                'label' => 'Добавить контакт',
                'url' => [$this->patchBackend.'create']
            ],
        ]
    ],
    [
        'label' => 'Типы контактов',
        'items' => [
            [
                'icon' => 'list-alt',
                'label' => 'Список типов',
                'url' => ['/contact/contactTypeBackend/index']
            ],
        ]
    ],
];
?>

<div class="page-header">
    <h1>
        <?php echo 'Контакты'; ?>
        <small><?php echo 'список'; ?></small>
    </h1>
</div>

    <p><?php echo 'На данной странице представлены средства управления контактами.'; ?></p>

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