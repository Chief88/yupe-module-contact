<? $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'contact-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => array('class' => 'well', 'enctype' => 'multipart/form-data'),
    )
); ?>
<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'type_id',
            array(
                'widgetOptions' => array(
                    'data'        => ContactType::model()->getListTypeContact(),
                    'htmlOptions' => array(
                        'empty'  => '--Выбрать--',
                        'encode' => false
                    ),
                ),
            )
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'category_id',
            array(
                'widgetOptions' => array(
                    'data'        => Category::model()->getFormattedList(
                        (int)Yii::app()->getModule('contact')->mainCategory
                    ),
                    'htmlOptions' => array(
                        'empty'  => Yii::t('ContactModule.contact', '--choose--'),
                        'encode' => false
                    ),
                ),
            )
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup(
            $model,
            'name'
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textAreaGroup($model, 'data'); ?>
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
