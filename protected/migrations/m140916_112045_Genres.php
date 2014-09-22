<?php

class m140916_112045_Genres extends CDbMigration
{
	public function up()
	{
        $this->createTable('genres', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('genres');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}