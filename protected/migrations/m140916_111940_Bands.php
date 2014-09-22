<?php

class m140916_111940_Bands extends CDbMigration
{
	public function up()
	{
        $this->createTable('bands', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('bands');
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