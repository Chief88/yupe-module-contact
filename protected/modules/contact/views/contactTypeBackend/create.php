<?php
$this->breadcrumbs = [
    Yii::t($this->aliasModule, 'Contact types') => [$this->patchBackend.'index'],
    Yii::t($this->aliasModule, 'Creation'),
];

$this->pageTitle = Yii::t($this->aliasModule, 'Add new type contact');

$this->menu = [
    [
        'label' => Yii::t($this->aliasModule, 'Contact types'),
        'items' => [
            [
                'icon' => 'list-alt',
                'label' => Yii::t($this->aliasModule, 'List types'),
                'url' => [$this->patchBackend.'index']
            ]
        ]
    ]
];
?>

<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Contact types'); ?>
        <small><?= Yii::t($this->aliasModule, 'creation'); ?></small>
    </h1>
</div>

<?php
$this->renderPartial('_form', [
    'model'=>$model,
]);