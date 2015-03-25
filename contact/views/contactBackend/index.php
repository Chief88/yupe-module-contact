<?php
$this->breadcrumbs = array(
    'Контакты' => array($this->patchBackend.'index'),
    'Список',
);

$this->pageTitle = 'Список контактов';

$this->menu = array(
    array(
        'label' => 'Контакты',
        'items' => array(
            array('icon' => 'list-alt',
                'label' => 'Список контактов',
                'url' => array($this->patchBackend.'index')
            ),
            array('icon' => 'plus-sign',
                'label' => 'Добавить контакт',
                'url' => array($this->patchBackend.'create')
            ),
        )
    ),
    array(
        'label' => 'Типы контактов',
        'items' => array(
            array(
                'icon' => 'list-alt',
                'label' => 'Список типов',
                'url' => array('/contact/contactTypeBackend/index')
            ),
        )
    ),
);
?>

<div class="page-header">
    <h1>
        <?php echo 'Контакты'; ?>
        <small><?php echo 'список'; ?></small>
    </h1>
</div>

    <p><?php echo 'На данной странице представлены средства управления контактами.'; ?></p>

<?php $this->widget('yupe\widgets\CustomGridView', array(
    'id'           => 'contact-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'sortField'    => 'type_id',
    'columns'      => array(
        array(
            'name'   => 'type_id',
            'value'  => '$data->contactType->name',
            'filter' => CHtml::activeDropDownList(
                $model,
                'type_id',
                ContactType::model()->getListNameType(),
                array('class' => 'form-control', 'encode' => false, 'empty' => '')
            ),
        ),
        array(
            'name'   => 'category_id',
            'value'  => '$data->getCategoryName()',
            'filter' => CHtml::activeDropDownList(
                $model,
                'category_id',
                Category::model()->getFormattedList(Yii::app()->getModule('contact')->mainCategory),
                array('class' => 'form-control', 'encode' => false, 'empty' => '')
            )
        ),
        'data',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{update}{delete}',
        ),
    ),
)); ?>