<?php

class m160418_034210_add_field_lang extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{contact_contact}}', 'lang', 'char(2) DEFAULT NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('{{contact_contact}}', 'lang');
	}
}