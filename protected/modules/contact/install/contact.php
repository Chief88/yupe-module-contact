<?php
/**
 *
 * Файл конфигурации модуля city
 *
 * @author Latyshkov
 *
 */
return array(
    'module'   => array(
        'class'  => 'application.modules.contact.ContactModule',
    ),
    'import'    => array(
        'application.modules.contact.models.*',
    ),
    'component' => array(
    ),
    'rules'     => array(
        '/contacts/<alias>' => 'contact/contact/show',
    ),
);