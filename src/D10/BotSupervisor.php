<?php

namespace AdventOfCode\D10;

use AdventOfCode\D10\Event\SetValueEvent;
use AdventOfCode\D10\Exceptions\BotNotFoundException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BotSupervisor implements EventSubscriberInterface
{
    /**
     * @var Bot[]
     */
    private $botList = [];

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public static function getSubscribedEvents()
    {
        return [
            SetValueEvent::class => 'onSetValueEvent',
        ];
    }

    /**
     * @param SetValueEvent $event
     */
    public function onSetValueEvent(SetValueEvent $event)
    {
        $botIndex = $event->getInstruction()->getBotIndex();
        if (!isset($this->botList[$botIndex])) {
            $this->botList[$botIndex] = new Bot($botIndex, $this->dispatcher);
            $this->botList[$botIndex]->onSetValueEvent($event);
            $this->dispatcher->addSubscriber($this->botList[$botIndex]);
        }
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return count($this->botList);
    }

    /**
     * @param int $botIndex
     *
     * @return Bot
     * @throws BotNotFoundException
     */
    public function getBot(int $botIndex)
    {
        if (!isset($this->botList[$botIndex])) {
            throw new BotNotFoundException();
        }

        return $this->botList[$botIndex];
    }
}
