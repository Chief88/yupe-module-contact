<?php
$this->breadcrumbs = [
    Yii::t($this->aliasModuleT, 'Типы контактов') => [$this->patchBackend.'index'],
    Yii::t($this->aliasModuleT, 'Добавление'),
];

$this->pageTitle = 'Добавить новый тип контакта';

$this->menu = [
    ['icon' => 'list-alt', 'label' => Yii::t(
        $this->aliasModuleT, 'Список типов'),
        'url' => [$this->patchBackend.'index']
    ],
];
?>

<div class="page-header">
    <h1>
        <?php echo 'Типы контактов'; ?>
        <small><?php echo 'добавление'; ?></small>
    </h1>
</div>

<?php
$this->renderPartial('_form', [
    'model'=>$model,
]);