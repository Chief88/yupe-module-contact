<?php
/**
 *
 * Файл конфигурации модуля contact
 *
 * @author Latyshkov
 *
 */
return [
    'module'   => [
        'class'  => 'application.modules.contact.ContactModule',
    ],
    'import'    => [
        'application.modules.contact.models.*',
    ],
    'component' => [],
    'rules'     => [
        '/contact/' => 'contact/contact/index',
        '/contact/<alias>' => 'contact/contact/show',
    ],
];