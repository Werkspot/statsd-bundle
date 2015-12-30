<?php
namespace Werkspot\Bundle\StatsdBundle\Client;

interface StatsdClientInterface
{
    /**
     * increments the key by 1
     *
     * @param string $key
     * @param int $sampleRate
     *
     * @return void
     */
    public function increment($key, $sampleRate = 1);

    /**
     * decrements the key by 1
     *
     * @param string $key
     * @param int $sampleRate
     *
     * @return void
     */
    public function decrement($key, $sampleRate = 1);

    /**
     * sends a count to statsd
     *
     * @param string $key
     * @param int $value
     * @param int $sampleRate (optional) the default is 1
     *
     * @return void
     */
    public function count($key, $value, $sampleRate = 1);

    /**
     * sends a timing to statsd (in ms)
     *
     * @param string $key
     * @param int $value the timing in ms
     * @param int $sampleRate the sample rate, if < 1, statsd will send an average timing
     *
     * @return void
     */
    public function timing($key, $value, $sampleRate = 1);

    /**
     * starts the timing for a key
     *
     * @param string $key
     *
     * @return void
     */
    public function startTiming($key);

    /**
     * ends the timing for a key and sends it to statsd
     *
     * @param string $key
     * @param int $sampleRate (optional)
     *
     * @return void
     */
    public function endTiming($key, $sampleRate = 1);

    /**
     * start memory "profiling"
     *
     * @param string $key
     *
     * @return void
     */
    public function startMemoryProfile($key);

    /**
     * ends the memory profiling and sends the value to the server
     *
     * @param string $key
     * @param int $sampleRate
     *
     * @return void
     */
    public function endMemoryProfile($key, $sampleRate = 1);

    /**
     * report memory usage to statsd. if memory was not given report peak usage
     *
     * @param string $key
     * @param int $memory
     * @param int $sampleRate
     *
     * @return void
     */
    public function memory($key, $memory = null, $sampleRate = 1);

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
    public function time($key, \Closure $_block, $sampleRate = 1);

    /**
     * sends a gauge, an arbitrary value to StatsD
     *
     * @param string $key
     * @param int $value
     *
     * @return void
     */
    public function gauge($key, $value);

    /**
     * sends a set member
     *
     * @param string $key
     * @param int $value
     *
     * @return void
     */
    public function set($key, $value);

    /**
     * changes the global key namespace
     *
     * @param string $namespace
     *
     * @return void
     */
    public function setNamespace($namespace);

    /**
     * gets the global key namespace
     *
     * @return string
     */
    public function getNamespace();

    /**
     * is batch processing running?
     *
     * @return boolean
     */
    public function isBatch();

    /**
     * start batch-send-recording
     *
     * @return void
     */
    public function startBatch();

    /**
     * ends batch-send-recording and sends the recorded messages to the connection
     *
     * @return void
     */
    public function endBatch();

    /**
     * stops batch-recording and resets the batch
     *
     * @return void
     */
    public function cancelBatch();
}
