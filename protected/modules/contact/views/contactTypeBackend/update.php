<?php
    $this->breadcrumbs = array(       
        Yii::t($this->aliasModuleT, 'Типы контактов') => array($this->patchBackend.'index'),
        $model->name => array($this->patchBackend.'view', 'id' => $model->id),
        Yii::t($this->aliasModuleT, 'Редактирование'),
    );

    $this->pageTitle = Yii::t($this->aliasModuleT, 'Типы контактов - редактирование');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t($this->aliasModuleT, 'Список типов'),
            'url' => array($this->patchBackend.'index')
        ),
        array('icon' => 'plus-sign', 'label' => Yii::t($this->aliasModuleT, 'Добавить тип'),
            'url' => array($this->patchBackend.'create')
        ),
        array('label' => Yii::t('ContactModule.contacty', 'Тип') . ' «' . mb_substr($model->name, 0, 32) . '»'),
        array('icon' => 'trash', 'label' => Yii::t($this->aliasModuleT, 'Удалить тип'),
            'url' => '#', 'linkOptions' => array(
                'submit' => array($this->patchBackend.'delete', 'id' => $model->id),
                'params' => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
                'confirm' => Yii::t($this->aliasModuleT, 'Вы действительно хотите удалить тип?'),
                'csrf' => true,
            )
        ),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModuleT, 'Редактирование типа контакта'); ?><br />
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php
    $this->renderPartial('_form', array(
        'model'=>$model,
    ));