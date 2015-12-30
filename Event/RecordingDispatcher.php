<?php

namespace Werkspot\Bundle\StatsdBundle\Event;

use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Werkspot\Bundle\StatsdBundle\Client\StatsdClientInterface;

class RecordingDispatcher implements EventDispatcherInterface
{
    /**
     * @var ContainerAwareEventDispatcher|EventDispatcherInterface
     */
    private $originalDispatcher;

    /**
     * @var StatsdClientInterface
     */
    private $statsdClient;

    /**
     * @param EventDispatcherInterface $originalDispatcher
     * @param StatsdClientInterface $statsdClient
     */
    public function __construct(
        EventDispatcherInterface $originalDispatcher,
        StatsdClientInterface $statsdClient
    ) {
        $this->originalDispatcher = $originalDispatcher;
        $this->statsdClient = $statsdClient;
    }

    /**
     * @see ContainerAwareEventDispatcher::addListenerService
     */
    public function addListenerService($eventName, $callback, $priority = 0)
    {
        $this->originalDispatcher->addListenerService($eventName, $callback, $priority);
    }

    /**
     * @see ContainerAwareEventDispatcher::addSubscriberService
     */
    public function addSubscriberService($serviceId, $class)
    {
        $this->originalDispatcher->addSubscriberService($serviceId, $class);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($eventName, Event $event = null)
    {
        $this->statsdClient->increment(str_replace('.', '-', $eventName));
        return $this->originalDispatcher->dispatch($eventName, $event);
    }

    /**
     * {@inheritdoc}
     */
    public function addListener($eventName, $listener, $priority = 0)
    {
        $this->originalDispatcher->addListener($eventName, $listener, $priority);
    }

    /**
     * {@inheritdoc}
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->originalDispatcher->addSubscriber($subscriber);
    }

    /**
     * {@inheritdoc}
     */
    public function removeListener($eventName, $listener)
    {
        $this->originalDispatcher->removeListener($eventName, $listener);
    }

    /**
     * {@inheritdoc}
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->originalDispatcher->removeSubscriber($subscriber);
    }

    /**
     * {@inheritdoc}
     */
    public function getListeners($eventName = null)
    {
        return $this->originalDispatcher->getListeners($eventName);
    }

    /**
     * {@inheritdoc}
     */
    public function hasListeners($eventName = null)
    {
        return $this->originalDispatcher->hasListeners($eventName);
    }


    /**
     * {@inheritdoc}
     */
    public function getListenerPriority($eventName, $listener)
    {
        return $this->getListenerPriority($eventName, $listener);
    }
}
