<?php

namespace Werkspot\Bundle\StatsdBundle\Tests\Event;

use Mockery;
use Mockery\MockInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Werkspot\Bundle\StatsdBundle\Client\StatsdClientInterface;
use Werkspot\Bundle\StatsdBundle\Event\RecordingDispatcher;

class RecordingDispatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventDispatcherInterface|MockInterface
     */
    private $mockOriginalDispatcher;

    /**
     * @var StatsdClientInterface|MockInterface
     */
    private $mockStatsdClient;

    /**
     * @var RecordingDispatcher
     */
    private $dispatcher;

    protected function setUp()
    {
        $this->mockOriginalDispatcher = Mockery::mock(EventDispatcherInterface::class);
        $this->mockStatsdClient = Mockery::mock(StatsdClientInterface::class);

        $this->dispatcher = new RecordingDispatcher($this->mockOriginalDispatcher, $this->mockStatsdClient);
    }

    public function testDispatch()
    {
        $mockEventName = 'a.b-c.d-e';
        $mockEvent = Mockery::mock(Event::class);

        $this->mockOriginalDispatcher->shouldReceive('dispatch')->with($mockEventName, $mockEvent);
        $this->mockStatsdClient->shouldReceive('increment')->with('a-b-c-d-e');

        $this->dispatcher->dispatch($mockEventName, $mockEvent);


    }

}
