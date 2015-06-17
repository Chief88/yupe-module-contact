<script type='text/javascript'>
    $(document).ready(function () {
        $('#contactType-form').liTranslit({
            elName: '#ContactType_name',
            elAlias: '#ContactType_nameEn'
        });
    })
</script>

<? $form = $this->beginWidget(
'bootstrap.widgets.TbActiveForm', array(
    'id'                     => 'contactType-form',
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'type'                   => 'vertical',
    'htmlOptions'            => array('class' => 'well', 'enctype' => 'multipart/form-data'),
)
); ?>
<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'name'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'nameEn'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'validation',
            array(
                'widgetOptions' => array(
                    'data'        => $model->getListValidates(),
                    'htmlOptions' => array(
                        'empty'  => '--Выбрать--',
                        'encode' => false
                    ),
                ),
            )
        ); ?>
    </div>
</div>

<br/>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? 'Создать и продолжить' : 'Сохранить и продолжить',
    )
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType'  => 'submit',
        'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
        'label'       => $model->isNewRecord ? 'Создать и закрыть' : 'Сохранить и закрыть',
    )
); ?>

<?php $this->endWidget(); ?>
