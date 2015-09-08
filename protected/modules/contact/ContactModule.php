<?php

use yupe\components\WebModule;

class ContactModule extends WebModule
{
    const VERSION = '0.9';

    public $uploadPath = 'contacts';
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    public $minSize = 0;
    public $maxSize = 5368709120;
    public $maxFiles = 1;
    public $rssCount = 10;
    public $perPage = 10;

    public  $aliasModule = 'ContactModule.contact';
    public  $patchBackend = '/contact/contactBackend/';

    public  $validates = array(
        array(
            'type' => 'none',
            'title' => 'Без валидации'
        ),
        array(
            'type' => 'phone',
            'title' => 'Телефон'
        ),
        array(
            'type' => 'email',
            'title' => 'E-mail'
        ),
        array(
            'type' => 'integer',
            'title' => 'Целое число'
        ),
    );

    public function getDependencies()
    {
        return array(
            'category',
        );
    }

    public function getInstall()
    {
        if (parent::getInstall()) {
            @mkdir(Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath, 0755);
        }

        return false;
    }

    public function getParamsLabels()
    {
        return array(
            'mainCategory'      => Yii::t($this->aliasModule, 'Main contacts category'),
            'adminMenuOrder'    => Yii::t($this->aliasModule, 'Menu items order')
        );
    }

    public function getEditableParams()
    {
        return array(
            'adminMenuOrder',
            'mainCategory' => CHtml::listData($this->getCategoryList(), 'id', 'name'),
        );
    }

    public function getEditableParamsGroups()
    {
        return array(
            'main'   => array(
                'label' => Yii::t($this->aliasModule, 'General module settings'),
                'items' => array(
                    'adminMenuOrder',
                    'mainCategory'
                )
            ),
        );
    }

    public function getVersion()
    {
        return self::VERSION;
    }

    public function getIsInstallDefault()
    {
        return true;
    }

    public function getCategory()
    {
        return Yii::t($this->aliasModule, 'Content');
    }

    public function getName()
    {
        return Yii::t($this->aliasModule, 'Contacts');
    }

    public function getDescription()
    {
        return Yii::t($this->aliasModule, 'Module for creating and management contacts');
    }

    public function getAuthor()
    {
        return Yii::t($this->aliasModule, 'Adelfo-Studio');
    }

    public function getAuthorEmail()
    {
        return Yii::t($this->aliasModule, 'serg.latyshkov@gmail.com');
    }

    public function getUrl()
    {
        return Yii::t($this->aliasModule, 'http://adelfo-studio.ru/');
    }

    public function getIcon()
    {
        return "fa fa-fw fa-list-alt";
    }

    public function getAdminPageLink()
    {
        return '/contact/contactBackend/index';
    }

    public function getNavigation()
    {
        return array(
            array(
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => Yii::t($this->aliasModule, 'Contacts list'),
                'url'   => array($this->patchBackend.'index')
            ),
            array(
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t($this->aliasModule, 'Create contact'),
                'url'   => array($this->patchBackend.'create')
            ),
        );
    }

    public function init()
    {
        parent::init();

        $this->setImport(
            array(
                'contact.models.*'
            )
        );
    }

    public function getAuthItems()
    {
        return [
            [
                'name'        => 'Contact.ContactManager',
                'description' => Yii::t($this->aliasModule, 'Manage contacts'),
                'type'        => AuthItem::TYPE_TASK,
                'items'       => [
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactBackend.Create',
                        'description' => Yii::t($this->aliasModule, 'Creating contacts')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactBackend.Delete',
                        'description' => Yii::t($this->aliasModule, 'Removing contacts')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactBackend.Index',
                        'description' => Yii::t($this->aliasModule, 'List of contacts')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactBackend.Update',
                        'description' => Yii::t($this->aliasModule, 'Editing contacts')
                    ],
                ]
            ],
            [
                'name'        => 'Contact.ContactTypeManager',
                'description' => Yii::t($this->aliasModule, 'Manage types contacts'),
                'type'        => AuthItem::TYPE_TASK,
                'items'       => [
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactTypeBackend.Create',
                        'description' => Yii::t($this->aliasModule, 'Creating type contacts')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactTypeBackend.Delete',
                        'description' => Yii::t($this->aliasModule, 'Removing type contacts')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactTypeBackend.Index',
                        'description' => Yii::t($this->aliasModule, 'List of types contacts')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Contact.ContactTypeBackend.Update',
                        'description' => Yii::t($this->aliasModule, 'Editing type contacts')
                    ],
                ]
            ]
        ];
    }

}
