<?php
/**
 *
 * Файл конфигурации модуля city
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
        '/contacts/<alias>' => 'contact/contact/show',
    ],
];