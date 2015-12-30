<?php
namespace Werkspot\Bundle\StatsdBundle\Service;

use Werkspot\Bundle\StatsdBundle\Client\StatsdClientInterface;

interface StatsdClientFactoryInterface
{
    /**
     * @param string $namespace
     *
     * @return StatsdClientInterface
     */
    public function getClient($namespace);
}
