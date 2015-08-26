<script type='text/javascript'>
    $(document).ready(function () {
        $('#contactType-form').liTranslit({
            elName: '#ContactType_name',
            elAlias: '#ContactType_nameEn'
        });
    })
</script>

<? $form = $this->beginWidget(
'bootstrap.widgets.TbActiveForm', [
    'id'                     => 'contactType-form',
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'type'                   => 'vertical',
    'htmlOptions'            => ['class' => 'well', 'enctype' => 'multipart/form-data'],
]
); ?>
<?= $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?= $form->textFieldGroup($model, 'name'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?= $form->textFieldGroup($model, 'nameEn'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?= $form->dropDownListGroup(
            $model,
            'validation',
            [
                'widgetOptions' => [
                    'data'        => $model->getListValidates(),
                    'htmlOptions' => [
                        'empty'  => '--Выбрать--',
                        'encode' => false
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<br/>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ?
            Yii::t($this->aliasModule, 'Create and continue') : Yii::t($this->aliasModule, 'Save and continue'),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord ?
            Yii::t($this->aliasModule, 'Create and close') : Yii::t($this->aliasModule, 'Save and close'),
    ]
); ?>

<?php $this->endWidget(); ?>
