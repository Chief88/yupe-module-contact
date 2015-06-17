<?php if (!empty($categoryModel)) {

    $this->pageTitle = !empty($categoryModel->page_title) ? $categoryModel->page_title : $this->pageTitle;
    $this->metaDescription = !empty($categoryModel->seo_description) ? $categoryModel->seo_description : $this->metaDescription;
    $this->metaKeywords = !empty($categoryModel->seo_keywords) ? $categoryModel->seo_keywords : $this->metaKeywords;
    $this->metaNoIndex = $categoryModel->no_index == 1 ? true : false;

} ?>

<div class="container">
    <h1>Контакты</h1>
    <div class="map-holder">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul id="tab-map" class="nav nav-tabs jstabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#map-2" aria-controls="profile" role="tab" data-toggle="tab">ТЦ Огни</a>
                </li>
                <li role="presentation">
                    <a href="#map-1" aria-controls="home" role="tab" data-toggle="tab">ТЦ Балтийский Базар</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane" id="map-1">

                    <?php if (Yii::app()->hasModule('contact')): ?>
                        <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                            'nameContact' => 'Карта (код виджета)',
                            'categoryId' => 14,
                        ]); ?>
                    <?php endif; ?>

                </div>
                <div role="tabpanel" class="tab-pane active" id="map-2">

                    <?php if (Yii::app()->hasModule('contact')): ?>
                        <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                            'nameContact' => 'Карта (код виджета)',
                            'categoryId' => 13,
                        ]); ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="font-24 fwb">Адреса  офисов:</div>
        <p>
            <?php if (Yii::app()->hasModule('contact')): ?>
                <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                    'nameContact' => 'Адрес',
                    'categoryId' => 13,
                ]); ?>
            <?php endif; ?>
            <br />
            <?php if (Yii::app()->hasModule('contact')): ?>
                <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                    'nameContact' => 'Адрес',
                    'categoryId' => 14,
                ]); ?>
            <?php endif; ?>
        </p>

        <div class="font-24 fwb">Телефоны:</div>
        <p><?php if (Yii::app()->hasModule('contact')): ?>
                <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                    'nameContact' => 'Телефон',
                    'categoryId' => 16,
                    'itemDelimiter' => '<br />',
                ]); ?>
            <?php endif; ?></p>

        <div class="font-24 fwb">Электронная почта:</div>
        <p>
            <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                'nameContact' => 'E-mail',
                'categoryId' => 16,
                'itemDelimiter' => '<br />',
            ]); ?>
        </p>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        var hash = window.location.hash;
        if(hash != ''){
            $('#tab-map a[href = "' + hash + '"]').tab('show')
        }
    });
</script>