<?php
$this->breadcrumbs = array(
    Yii::t($this->aliasModuleT, 'Типы контактов') => array($this->patchBackend.'index'),
    Yii::t($this->aliasModuleT, 'Добавление'),
);

$this->pageTitle = 'Добавить новый тип контакта';

$this->menu = array(
    array('icon' => 'list-alt', 'label' => Yii::t(
        $this->aliasModuleT, 'Список типов'),
        'url' => array($this->patchBackend.'index')
    ),
);
?>

<div class="page-header">
    <h1>
        <?php echo 'Типы контактов'; ?>
        <small><?php echo 'добавление'; ?></small>
    </h1>
</div>

<?php
$this->renderPartial('_form', array(
    'model'=>$model,
));