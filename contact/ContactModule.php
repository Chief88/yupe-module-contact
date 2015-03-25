<?php

use yupe\components\WebModule;

class ContactModule extends WebModule
{
    const VERSION = '0.9';

    public $uploadPath = 'news';
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
            'user',
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

//    public function checkSelf()
//    {
//        $messages = array();
//
//        $uploadPath = Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;
//
//        if (!is_writable($uploadPath)) {
//            $messages[WebModule::CHECK_ERROR][] = array(
//                'type'    => WebModule::CHECK_ERROR,
//                'message' => Yii::t(
//                        $this->aliasModule,
//                        'Directory "{dir}" is not accessible for write! {link}',
//                        array(
//                            '{dir}'  => $uploadPath,
//                            '{link}' => CHtml::link(
//                                    Yii::t($this->aliasModule, 'Change settings'),
//                                    array(
//                                        '/yupe/backend/modulesettings/',
//                                        'module' => 'news',
//                                    )
//                                ),
//                        )
//                    ),
//            );
//        }
//
//        return (isset($messages[WebModule::CHECK_ERROR])) ? $messages : true;
//    }

    public function getParamsLabels()
    {
        return array(
            'mainCategory'      => Yii::t($this->aliasModule, 'Main contacts category'),
            'adminMenuOrder'    => Yii::t($this->aliasModule, 'Menu items order'),
//            'editor'            => Yii::t($this->aliasModule, 'Visual Editor'),
//            'uploadPath'        => Yii::t(
//                    $this->aliasModule,
//                    'Uploading files catalog (relatively {path})',
//                    array(
//                        '{path}' => Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . Yii::app()->getModule(
//                                "yupe"
//                            )->uploadPath
//                    )
//                ),
//            'allowedExtensions' => Yii::t($this->aliasModule, 'Accepted extensions (separated by comma)'),
//            'minSize'           => Yii::t($this->aliasModule, 'Minimum size (in bytes)'),
//            'maxSize'           => Yii::t($this->aliasModule, 'Maximum size (in bytes)'),
//            'rssCount'          => Yii::t($this->aliasModule, 'RSS records'),
//            'perPage'           => Yii::t($this->aliasModule, 'News per page')
        );
    }

    public function getEditableParams()
    {
        return array(
            'adminMenuOrder',
            'mainCategory' => CHtml::listData($this->getCategoryList(), 'id', 'name'),
//            'uploadPath',
//            'allowedExtensions',
//            'minSize',
//            'maxSize',
//            'rssCount',
//            'perPage'
//            'editor'       => Yii::app()->getModule('yupe')->getEditors(),
        );
    }

    public function getEditableParamsGroups()
    {
        return array(
            'main'   => array(
                'label' => Yii::t($this->aliasModule, 'General module settings'),
                'items' => array(
                    'adminMenuOrder',
//                    'editor',
                    'mainCategory'
                )
            ),
//            'images' => array(
//                'label' => Yii::t($this->aliasModule, 'Images settings'),
//                'items' => array(
//                    'uploadPath',
//                    'allowedExtensions',
//                    'minSize',
//                    'maxSize'
//                )
//            ),
//            'list'   => array(
//                'label' => Yii::t($this->aliasModule, 'News lists'),
//                'items' => array(
//                    'rssCount',
//                    'perPage'
//                )
//            ),
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

//    public function getAuthItems()
//    {
//        return array(
//            array(
//                'name'        => 'News.NewsManager',
//                'description' => Yii::t($this->aliasModule, 'Manage news'),
//                'type'        => AuthItem::TYPE_TASK,
//                'items'       => array(
//                    array(
//                        'type'        => AuthItem::TYPE_OPERATION,
//                        'name'        => 'News.NewsBackend.Create',
//                        'description' => Yii::t($this->aliasModule, 'Creating news')
//                    ),
//                    array(
//                        'type'        => AuthItem::TYPE_OPERATION,
//                        'name'        => 'News.NewsBackend.Delete',
//                        'description' => Yii::t($this->aliasModule, 'Removing news')
//                    ),
//                    array(
//                        'type'        => AuthItem::TYPE_OPERATION,
//                        'name'        => 'News.NewsBackend.Index',
//                        'description' => Yii::t($this->aliasModule, 'List of news')
//                    ),
//                    array(
//                        'type'        => AuthItem::TYPE_OPERATION,
//                        'name'        => 'News.NewsBackend.Update',
//                        'description' => Yii::t($this->aliasModule, 'Editing news')
//                    ),
//                    array(
//                        'type'        => AuthItem::TYPE_OPERATION,
//                        'name'        => 'News.NewsBackend.Inline',
//                        'description' => Yii::t($this->aliasModule, 'Editing news')
//                    ),
//                    array(
//                        'type'        => AuthItem::TYPE_OPERATION,
//                        'name'        => 'News.NewsBackend.View',
//                        'description' => Yii::t($this->aliasModule, 'Viewing news')
//                    ),
//                )
//            )
//        );
//    }
}
