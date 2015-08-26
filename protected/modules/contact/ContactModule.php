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

    public  $validates = [
        [
            'type' => 'none',
            'title' => 'Без валидации'
        ],
        [
            'type' => 'phone',
            'title' => 'Телефон'
        ],
        [
            'type' => 'email',
            'title' => 'E-mail'
        ],
        [
            'type' => 'integer',
            'title' => 'Целое число'
        ],
    ];

    public function getDependencies()
    {
        return [
            'category',
        ];
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
        return [
            'mainCategory'      => Yii::t($this->aliasModule, 'Main contacts category'),
            'adminMenuOrder'    => Yii::t($this->aliasModule, 'Menu items order')
        ];
    }

    public function getEditableParams()
    {
        return [
            'adminMenuOrder',
            'mainCategory' => CHtml::listData($this->getCategoryList(), 'id', 'name'),
        ];
    }

    public function getEditableParamsGroups()
    {
        return [
            'main'   => [
                'label' => Yii::t($this->aliasModule, 'General module settings'),
                'items' => [
                    'adminMenuOrder',
                    'mainCategory'
                ]
            ],
        ];
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
        return [
            [
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => Yii::t($this->aliasModule, 'Contacts list'),
                'url'   => [$this->patchBackend.'index']
            ],
            [
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t($this->aliasModule, 'Create contact'),
                'url'   => [$this->patchBackend.'create']
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'contact.models.*'
            ]
        );
    }

}
