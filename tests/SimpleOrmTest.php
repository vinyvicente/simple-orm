<?php

class SimpleOrmTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $orm = new \SimpleOrm\SimpleOrm([
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'bar',
            'db_name' => 'foo',
        ]);

        $this->assertInstanceOf('\\SimpleOrm\\SimpleOrm', $orm);
        $this->assertFalse($orm->isConnected());
    }

    public function testConnection()
    {
    }
}
