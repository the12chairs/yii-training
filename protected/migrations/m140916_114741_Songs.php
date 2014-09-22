<?php

class m140916_114741_Songs extends CDbMigration
{
	public function up()
	{
        $this->createTable('songs', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'band_id' => 'int NOT NULL',
        ));

        $this->addForeignKey('fk_band', 'songs', 'band_id', 'bands', 'id', 'cascade', 'cascade');

	}

	public function down()
	{
        $this->dropTable('songs');
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