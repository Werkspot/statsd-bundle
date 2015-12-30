<?php

namespace Werkspot\Bundle\StatsdBundle\Service;

use Domnikl\Statsd\Connection\Blackhole;
use Werkspot\Bundle\StatsdBundle\Client\StatsdClient;
use Werkspot\Bundle\StatsdBundle\Client\StatsdClientInterface;

class BlackholeClientFactory implements StatsdClientFactoryInterface
{
    /**
     * @param string $namespace
     *
     * @return StatsdClientInterface
     */
    public function getClient($namespace)
    {
        $connection = new Blackhole();
        return new StatsdClient($connection, $namespace);
    }
}
