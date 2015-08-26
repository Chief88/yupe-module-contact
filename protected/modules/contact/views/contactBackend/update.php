<?php
    $this->breadcrumbs = [
        'Контакты' => [$this->patchBackend.'index'],
        $model->id => [$this->patchBackend.'view', 'id' => $model->id],
        'Редактирование',
    ];

    $this->pageTitle = 'Контакты - редактирование';

    $this->menu = [
        ['icon' => 'list-alt', 'label' => 'Список контактов', 'url' => [$this->patchBackend.'index']],
        ['icon' => 'plus-sign', 'label' => 'Добавить контакт', 'url' => [$this->patchBackend.'create']],
        ['label' => 'Контакт' . ' «' . mb_substr($model->id, 0, 32) . '»'],
        ['icon' => 'trash', 'label' => 'Удалить контакты', 'url' => '#', 'linkOptions' => [
            'submit' => [$this->patchBackend.'delete', 'id' => $model->id],
            'params' => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
            'confirm' => 'Вы действительно хотите удалить контакты?',
            'csrf' => true,
        ]],
    ];
?>
<div class="page-header">
    <h1>
        <?php echo 'Редактирование контактов'; ?><br />
        <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php
    $this->renderPartial('_form', [
        'model'=>$model,
    ]);