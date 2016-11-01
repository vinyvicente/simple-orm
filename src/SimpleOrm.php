<?php

namespace SimpleOrm;

use SimpleOrm\Service\Connection;

/**
 * Class SimpleOrm
 * @package SimpleOrm
 */
class SimpleOrm
{
    const DISCONNECTED = 'disconnected';
    const CONNECTED = 'connected';

    /**
     * @var array
     */
    private $config;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var bool
     */
    private $connected = false;

    public function __construct(array $config)
    {
        $this->config = $config;

        $this->connect();
    }

    /**
     *
     */
    private function connect()
    {
        try{
            $this->connection = new Connection();
            $this->connection->setHost($this->config['host'])
                ->setUser($this->config['user'])
                ->setPassword($this->config['password'])
                ->setDbName($this->config['db_name'])
                ->connect();

            $this->connected = $this->connection->isConnected();

            if ($this->connected &&
                $this->connection->getDriver() == Connection::MYSQL &&
                $this->connection->getCharset() == Connection::DEFAULT_CHARSET) {
                $this->connection->getInstance()->query('SET NAMES utf8;');
            }

        } catch (\Exception $e) {
        }
    }

    /**
     * @return boolean
     */
    public function isConnected(): bool
    {
        return $this->connected;
    }
}
