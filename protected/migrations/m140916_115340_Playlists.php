<?php

class m140916_115340_Playlists extends CDbMigration
{
	public function up()
	{

        $this->createTable('playlists', array(
            'id' => 'pk',
            'user_id' => 'int NOT NULL',
            'song_id' => 'int NOT NULL',
        ));

        $this->addForeignKey('fk_user',  'playlists', 'user_id', 'users', 'id', 'cascade');
        $this->addForeignKey('fk_song',  'playlists', 'song_id', 'songs', 'id', 'cascade');

    }

    public function down()
    {
        //$this->dropTable('playlists');
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