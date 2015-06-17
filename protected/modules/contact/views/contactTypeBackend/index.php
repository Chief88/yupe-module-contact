<?php
$this->breadcrumbs = array(
    'Типы контактов' => array($this->patchBackend.'index'),
    'Список',
);

$this->pageTitle = 'Список типов контактов';

$this->menu = array(
    array(
        'label' => 'Типы контактов',
        'items' => array(
            array('icon' => 'list-alt',
                'label' => 'Список типов',
                'url' => array($this->patchBackend.'index')
            ),
            array('icon' => 'plus-sign',
                'label' => 'Добавить тип',
                'url' => array($this->patchBackend.'create')
            ),
        )
    ),
    array(
        'label' => 'Контакты',
        'items' => array(
            array(
                'icon' => 'list-alt',
                'label' => 'Список контактов',
                'url' => array('/contact/contactBackend/index')
            ),
        )
    ),
); ?>

<div class="page-header">
    <h1>
        <?php echo 'Типы контактов'; ?>
        <small><?php echo 'список'; ?></small>
    </h1>
</div>

    <p><?php echo 'На данной странице представлены средства управления типами контактов.'; ?></p>

<?php $this->widget('yupe\widgets\CustomGridView', array(
    'id'           => 'contactType-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'sortField'    => 'name',
    'columns'      => array(
        'name',
        array(
            'name'   => 'validation',
            'value'  => '$data->getTitleValidation()',
            'filter' => CHtml::activeDropDownList(
                $model,
                'validation',
                $model->getListValidates(),
                array('class' => 'form-control', 'encode' => false, 'empty' => '')
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{update}{delete}',
        ),
    ),
)); ?>