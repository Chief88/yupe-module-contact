<? $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id'                     => 'contact-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>
<?= $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?= $form->dropDownListGroup(
            $model,
            'type_id',
            [
                'widgetOptions' => [
                    'data'        => ContactType::model()->getListTypeContact(),
                    'htmlOptions' => [
                        'empty'  => '--Выбрать--',
                        'encode' => false
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?= $form->dropDownListGroup(
            $model,
            'category_id',
            [
                'widgetOptions' => [
                    'data'        => Category::model()->getFormattedList(
                        (int)Yii::app()->getModule('contact')->mainCategory
                    ),
                    'htmlOptions' => [
                        'empty'  => Yii::t('ContactModule.contact', '--choose--'),
                        'encode' => false
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?= $form->textFieldGroup(
            $model,
            'name'
        ); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php
        echo CHtml::image(
            !$model->isNewRecord && $model->image ? $model->getImageUrl() : '#',
            $model->name,
            [
                'class' => 'preview-image',
                'style' => !$model->isNewRecord && $model->image ? '' : 'display:none'
            ]
        ); ?>

        <?php if (!$model->isNewRecord && $model->image): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="delete-file"> <?= Yii::t('ContactModule.contact', 'Delete the file') ?>
                </label>
            </div>
        <?php endif; ?>

        <?= $form->fileFieldGroup(
            $model,
            'image',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'onchange' => 'readURL(this);',
                        'style'    => 'background-color: inherit;'
                    ]
                ]
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?= $form->textAreaGroup($model, 'data'); ?>
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