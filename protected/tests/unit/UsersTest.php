<?php
class UsersTest extends CDbTestCase {
    // Just simple test for phing training
    public $fixtures=array(
        'users' => 'Users',
    );
    public function testDefaultRole()
    {
        $usr = new Users;
        $usr->password = 'qwerty';
        $usr->login = 'log';
        $usr->save();
        $this->assertEquals($usr->role, 'user'); // Test default value of role
    }
}