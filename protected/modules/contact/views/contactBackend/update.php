<?php
    $this->breadcrumbs = array(       
        'Контакты' => array($this->patchBackend.'index'),
        $model->id => array($this->patchBackend.'view', 'id' => $model->id),
        'Редактирование',
    );

    $this->pageTitle = 'Контакты - редактирование';

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => 'Список контактов', 'url' => array($this->patchBackend.'index')),
        array('icon' => 'plus-sign', 'label' => 'Добавить контакт', 'url' => array($this->patchBackend.'create')),
        array('label' => 'Контакт' . ' «' . mb_substr($model->id, 0, 32) . '»'),
        array('icon' => 'trash', 'label' => 'Удалить контакты', 'url' => '#', 'linkOptions' => array(
            'submit' => array($this->patchBackend.'delete', 'id' => $model->id),
            'params' => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
            'confirm' => 'Вы действительно хотите удалить контакты?',
            'csrf' => true,
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo 'Редактирование контактов'; ?><br />
        <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php
    $this->renderPartial('_form', array(
        'model'=>$model,
    ));