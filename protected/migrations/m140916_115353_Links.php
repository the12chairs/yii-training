<?php

class m140916_115353_Links extends CDbMigration
{
	public function up()
	{

        $this->createTable('links', array(
            'id' => 'pk',
            'genre_id' => 'int NOT NULL',
            'song_id' => 'int NOT NULL',
        ));

        $this->addForeignKey('fk_gnr', 'links', 'genre_id', 'genres', 'id', 'cascade');
        $this->addForeignKey('fk_sng', 'links', 'song_id', 'songs', 'id', 'cascade');
    }

    public function down()
    {
        $this->dropTable('links');
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