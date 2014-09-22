<?php

class m140916_111640_Users extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
            'id' => 'pk',
            'login' => 'string NOT NULL',
            'email' => 'string NOT NULL',
            'password' => 'string NOT NULL',
            'role' => 'string NOT NULL DEFAULT "user"',
        ));

        // Here will be admin generation code
        // blah-blah

	}

	public function down()
	{
        $this->dropTable('users');
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