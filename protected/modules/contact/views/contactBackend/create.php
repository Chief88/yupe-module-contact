<?php
$this->breadcrumbs = array(
    'Контакты' => array($this->patchBackend.'index'),
    'Добавление',
);

$this->pageTitle = 'Добавить новые контакты';

$this->menu = array(
    array('icon' => 'list-alt', 'label' => 'Просмотреть список контактов',
    'url' => array($this->patchBackend.'index')),
);
?>

<div class="page-header">
    <h1>
        <?php echo 'Контакты'; ?>
        <small><?php echo 'добавление'; ?></small>
    </h1>
</div>

<?php
$this->renderPartial('_form', array(
    'model'=>$model,
));