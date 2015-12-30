<?php

namespace Werkspot\Bundle\StatsdBundle\Tests\Client;

use Domnikl\Statsd\Connection;
use Mockery;
use Mockery\MockInterface;
use Werkspot\Bundle\StatsdBundle\Client\StatsdClient;

class StatsdClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var StatsdClient */
    private $statsdClient;

    /** @var Connection|MockInterface */
    private $mockConnection;

    protected function setUp()
    {
        $this->mockConnection = Mockery::mock(Connection::class);
        $this->statsdClient = new StatsdClient($this->mockConnection, 'test');
    }

    public function testIncrement()
    {
        $mockKey = uniqid();
        $this->mockConnection->shouldReceive('send')->once()->with('test.'.$mockKey . ':1|c');

        $this->statsdClient->increment($mockKey);
    }

    public function testDecrement()
    {
        $mockKey = uniqid();
        $this->mockConnection->shouldReceive('send')->once()->with('test.'.$mockKey . ':-1|c');

        $this->statsdClient->decrement($mockKey);
    }

    public function testCount()
    {
        $mockKey = uniqid();
        $this->mockConnection->shouldReceive('send')->once()->with('test.'.$mockKey . ':1234|c');

        $this->statsdClient->count($mockKey, 1234);
    }
}
