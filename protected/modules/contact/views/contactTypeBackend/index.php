<?php
$this->breadcrumbs = [
    'Типы контактов' => [$this->patchBackend.'index'],
    'Список',
];

$this->pageTitle = 'Список типов контактов';

$this->menu = [
    [
        'label' => 'Типы контактов',
        'items' => [
            [
                'icon' => 'list-alt',
                'label' => 'Список типов',
                'url' => [$this->patchBackend.'index']
            ],
            [
                'icon' => 'plus-sign',
                'label' => 'Добавить тип',
                'url' => [$this->patchBackend.'create']
            ],
        ]
    ],
    [
        'label' => 'Контакты',
        'items' => [
            [
                'icon' => 'list-alt',
                'label' => 'Список контактов',
                'url' => ['/contact/contactBackend/index']
            ],
        ]
    ],
]; ?>

<div class="page-header">
    <h1>
        <?php echo 'Типы контактов'; ?>
        <small><?php echo 'список'; ?></small>
    </h1>
</div>

    <p><?php echo 'На данной странице представлены средства управления типами контактов.'; ?></p>

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