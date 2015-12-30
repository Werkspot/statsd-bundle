<?php

namespace Werkspot\Bundle\StatsdBundle\Service;

use Domnikl\Statsd\Connection\UdpSocket;
use Werkspot\Bundle\StatsdBundle\Client\StatsdClient;
use Werkspot\Bundle\StatsdBundle\Client\StatsdClientInterface;

class LocalUdpClientFactory implements StatsdClientFactoryInterface
{
    /**
     * @var string
     */
    private $applicationPrefix;

    /**
     * @var UdpSocket
     */
    private $connection;

    /**
     * @param string $applicationPrefix
     * @param array $connectionOptions
     */
    public function __construct($applicationPrefix = '', array $connectionOptions = [])
    {
        $host = isset($connectionOptions['host']) ? $connectionOptions['host'] : '127.0.0.1';
        $port = isset($connectionOptions['port']) ? $connectionOptions['port'] : '8125';
        $timeout = isset($connectionOptions['timeout']) ? $connectionOptions['timeout'] : null;
        $persistent = isset($connectionOptions['persistent']) ? $connectionOptions['persistent'] : false;

        $this->connection = new UdpSocket($host, $port, $timeout, $persistent);
        $this->applicationPrefix = $applicationPrefix;
    }

    /**
     * @param string $namespace
     *
     * @return StatsdClientInterface
     */
    public function getClient($namespace)
    {
        $namespace = $this->applicationPrefix . $namespace;
        return new StatsdClient($this->connection, $namespace);
    }
}
