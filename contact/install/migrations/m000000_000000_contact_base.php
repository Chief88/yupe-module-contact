<?php
/**
 * News install migration
 * Класс миграций для модуля Contact
 *
 * @category YupeMigration
 * @package  yupe.modules.contact.install.migrations
 * @author   Adelfo Development <serg.latyshkov@gmail.com>
 **/
class m000000_000000_contact_base extends yupe\components\DbMigration{

    public function safeUp(){

        $this->createTable(
            '{{contact_contact}}',
            array(
                'id' => 'pk',
                'data' => 'text NOT NULL',
                'name' => 'varchar(250) NOT NULL',
                'type_id' => 'int(11) NOT NULL',
                'category_id' => 'int(11) DEFAULT NULL',
            ), $this->getOptions()
        );

        $this->createTable(
            '{{contact_type}}',
            array(
                'id' => 'pk',
                'name' => 'text NOT NULL',
                'nameEn' => 'text NOT NULL',
                'validation' => 'varchar(250) NOT NULL',
            ), $this->getOptions()
        );

    }

    public function safeDown(){
        $this->dropTableWithForeignKeys('{{contact_contact}}');
        $this->dropTableWithForeignKeys('{{contact_type}}');
    }
}