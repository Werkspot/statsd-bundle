<?php

namespace Werkspot\Bundle\StatsdBundle\Client;

use Domnikl\Statsd\Client;
use Domnikl\Statsd\Connection;

class StatsdClient implements StatsdClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Connection $connection
     * @param string $namespace
     */
    public function __construct(Connection $connection, $namespace = '')
    {
        $this->client = new Client($connection, $namespace);
    }

    /**
     * increments the key by 1
     *
     * @param string $key
     * @param int $sampleRate
     *
     * @return void
     */
    public function increment($key, $sampleRate = 1)
    {
        $this->client->increment($key, $sampleRate);
    }

    /**
     * decrements the key by 1
     *
     * @param string $key
     * @param int $sampleRate
     *
     * @return void
     */
    public function decrement($key, $sampleRate = 1)
    {
        $this->client->decrement($key, $sampleRate);
    }
    /**
     * sends a count to statsd
     *
     * @param string $key
     * @param int $value
     * @param int $sampleRate (optional) the default is 1
     *
     * @return void
     */
    public function count($key, $value, $sampleRate = 1)
    {
        $this->client->count($key, $value, $sampleRate);
    }

    /**
     * sends a timing to statsd (in ms)
     *
     * @param string $key
     * @param int $value the timing in ms
     * @param int $sampleRate the sample rate, if < 1, statsd will send an average timing
     *
     * @return void
     */
    public function timing($key, $value, $sampleRate = 1)
    {
        $this->client->timing($key, $value, $sampleRate);
    }

    /**
     * starts the timing for a key
     *
     * @param string $key
     *
     * @return void
     */
    public function startTiming($key)
    {
        $this->client->startTiming($key);
    }

    /**
     * ends the timing for a key and sends it to statsd
     *
     * @param string $key
     * @param int $sampleRate (optional)
     *
     * @return void
     */
    public function endTiming($key, $sampleRate = 1)
    {
        $this->client->endTiming($key, $sampleRate);
    }

    /**
     * start memory "profiling"
     *
     * @param string $key
     *
     * @return void
     */
    public function startMemoryProfile($key)
    {
        $this->client->startMemoryProfile($key);
    }

    /**
     * ends the memory profiling and sends the value to the server
     *
     * @param string $key
     * @param int $sampleRate
     *
     * @return void
     */
    public function endMemoryProfile($key, $sampleRate = 1)
    {
        $this->client->endMemoryProfile($key, $sampleRate);
    }

    /**
     * report memory usage to statsd. if memory was not given report peak usage
     *
     * @param string $key
     * @param int $memory
     * @param int $sampleRate
     *
     * @return void
     */
    public function memory($key, $memory = null, $sampleRate = 1)
    {
        $this->client->memory($key, $memory, $sampleRate);
    }

    /**
     * executes a Closure and records it's execution time and sends it to statsd
     * returns the value the Closure returned
     *
     * @param string $key
     * @param \Closure $_block
     * @param int $sampleRate (optional) default = 1
     *
     * @return mixed
     */
    public function time($key, \Closure $_block, $sampleRate = 1)
    {
        return $this->client->time($key, $_block, $sampleRate);
    }

    /**
     * sends a gauge, an arbitrary value to StatsD
     *
     * @param string $key
     * @param int $value
     *
     * @return void
     */
    public function gauge($key, $value)
    {
        $this->client->gauge($key, $value);
    }

    /**
     * sends a set member
     *
     * @param string $key
     * @param int $value
     *
     * @return void
     */
    public function set($key, $value)
    {
        $this->client->set($key, $value);
    }

    /**
     * changes the global key namespace
     *
     * @param string $namespace
     *
     * @return void
     */
    public function setNamespace($namespace)
    {
        $this->client->setNamespace($namespace);
    }

    /**
     * gets the global key namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->client->getNamespace();
    }

    /**
     * is batch processing running?
     *
     * @return boolean
     */
    public function isBatch()
    {
        return $this->client->isBatch();
    }

    /**
     * start batch-send-recording
     *
     * @return void
     */
    public function startBatch()
    {
        $this->client->startBatch();
    }

    /**
     * ends batch-send-recording and sends the recorded messages to the connection
     *
     * @return void
     */
    public function endBatch()
    {
        $this->client->endBatch();
    }

    /**
     * stops batch-recording and resets the batch
     *
     * @return void
     */
    public function cancelBatch()
    {
        $this->client->cancelBatch();
    }
}
