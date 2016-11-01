<?php

namespace SimpleOrm\Service;

/**
 * Class Connection
 * @package SimpleOrm\Service
 */
class Connection
{
    const MYSQL = 'mysql';
    const MYSQL_DEFAULT_PORT = 3306;
    const DEFAULT_CHARSET = 'UTF8';

    /**
     * @var string
     */
    protected $driver = self::MYSQL;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var int
     */
    protected $port = self::MYSQL_DEFAULT_PORT;

    /**
     * @var string
     */
    protected $dbName;

    /**
     * @var string
     */
    protected $charset = self::DEFAULT_CHARSET;

    /**
     * @var array
     */
    protected $availableDrivers = [self::MYSQL];

    /**
     * @var \PDO
     */
    protected $instance;

    /**
     * @return \PDO
     */
    public function connect()
    {
        try {
            $this->instance = new \PDO(
                sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s;',
                    $this->driver,
                    $this->host,
                    $this->port,
                    $this->dbName,
                    $this->charset
                ),
                $this->user,
                $this->password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (\PDOException $e) {
        }

        return $this->instance;
    }

    /**
     * @return \PDO
     */
    public function getInstance(): \PDO
    {
        return $this->instance instanceof \PDO ? $this->instance : new \PDO('');
    }

    /**
     * @return bool
     */
    public function isConnected()
    {
        return !empty($this->getInstance()->getAttribute(\PDO::ATTR_CONNECTION_STATUS));
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     * @return Connection
     */
    public function setDriver(string $driver): Connection
    {
        if (!in_array($driver, $this->availableDrivers)) {
            throw new \InvalidArgumentException('Driver not available actually.');
        }

        $this->driver = $driver;

        return $this;
    }

    /**
     * @param string $host
     * @return Connection
     */
    public function setHost(string $host): Connection
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param string $user
     * @return Connection
     */
    public function setUser(string $user): Connection
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param string $password
     * @return Connection
     */
    public function setPassword(string $password): Connection
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param array $options
     * @return Connection
     */
    public function setOptions(array $options): Connection
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param int $port
     * @return Connection
     */
    public function setPort(int $port): Connection
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @param string $dbName
     * @return Connection
     */
    public function setDbName(string $dbName): Connection
    {
        $this->dbName = $dbName;
        return $this;
    }

    /**
     * @param string $charset
     * @return Connection
     */
    public function setCharset(string $charset): Connection
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }
}
