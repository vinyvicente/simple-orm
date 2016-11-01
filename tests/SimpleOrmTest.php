<?php

class SimpleOrmTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $orm = new \SimpleOrm\SimpleOrm([]);

        $this->assertInstanceOf('\\SimpleOrm\\SimpleOrm', $orm);
        $this->assertFalse($orm->isConnected());
    }
}
