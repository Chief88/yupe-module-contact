<?php
$this->breadcrumbs = [
    'Контакты' => [$this->patchBackend.'index'],
    'Добавление',
];

$this->pageTitle = 'Добавить новые контакты';

$this->menu = [
    ['icon' => 'list-alt', 'label' => 'Просмотреть список контактов',
    'url' => [$this->patchBackend.'index']],
];
?>

<div class="page-header">
    <h1>
        <?php echo 'Контакты'; ?>
        <small><?php echo 'добавление'; ?></small>
    </h1>
</div>

<?php
$this->renderPartial('_form', [
    'model'=>$model,
]);