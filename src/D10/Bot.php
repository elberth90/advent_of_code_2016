<?php

namespace AdventOfCode\D10;

use AdventOfCode\D10\Event\CommandEvent;
use AdventOfCode\D10\Event\HighForBotEvent;
use AdventOfCode\D10\Event\HighToOutputEvent;
use AdventOfCode\D10\Event\LowForBotEvent;
use AdventOfCode\D10\Event\LowToOutputEvent;
use AdventOfCode\D10\Event\SetOutputEvent;
use AdventOfCode\D10\Event\SetValueEvent;
use AdventOfCode\D10\Instruction\SetValueInstruction;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Bot implements EventSubscriberInterface
{
    /**
     * @var int|null
     */
    private $lowValue = null;

    /**
     * @var int|null
     */
    private $highValue = null;

    /**
     * @var int|null
     */
    private $outputLowValue = null;

    /**
     * @var int|null
     */
    private $outputHighValue = null;

    /**
     * @var int
     */
    private $botIndex;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param int                      $botIndex
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(int $botIndex, EventDispatcherInterface $dispatcher)
    {
        $this->botIndex = $botIndex;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            SetValueEvent::class => 'onSetValueEvent',
            SetOutputEvent::class => 'onSetOutputValueEvent',
            LowForBotEvent::class => 'onLowForBotEvent',
            HighForBotEvent::class => 'onHighForBotEvent',
            LowToOutputEvent::class => 'onLowToOutputEvent',
            HighToOutputEvent::class => 'onHighToOutputEvent',
        ];
    }

    /**
     * @param SetValueEvent $event
     */
    public function onSetValueEvent(SetValueEvent $event)
    {
        if ($this->botIndex !== $event->getInstruction()->getBotIndex()) {
            return;
        }

        $value = $event->getInstruction()->getValue();
        if (is_null($this->highValue)) {
            $this->highValue = $value;

            return;
        }

        if ($value > $this->highValue) {
            $this->lowValue = $this->highValue;
            $this->highValue = $value;

            return;
        }

        $this->lowValue = $value;
    }

    /**
     * @param SetOutputEvent $event
     */
    public function onSetOutputValueEvent(SetOutputEvent $event)
    {
        if ($this->botIndex !== $event->getInstruction()->getBotIndex()) {
            return;
        }

        $value = $event->getInstruction()->getValue();
        if (is_null($this->outputHighValue)) {
            $this->outputHighValue = $value;

            return;
        }

        if ($value > $this->outputHighValue) {
            $this->outputLowValue = $this->outputHighValue;
            $this->outputHighValue = $value;

            return;
        }

        $this->outputLowValue = $value;
    }

    /**
     * @param LowForBotEvent $event
     */
    public function onLowForBotEvent(LowForBotEvent $event)
    {
        if ($this->botIndex !== $event->getInstruction()->getBotIndex()) {
            return;
        }

        if (is_null($this->lowValue)) {
            return;
        }

        $instruction = new SetValueInstruction($event->getInstruction()->getLowBotIndex(), $this->lowValue);
        $this->dispatcher->dispatch(SetValueEvent::class, new SetValueEvent($instruction));
        $this->lowValue = null;
    }

    /**
     * @param HighForBotEvent $event
     */
    public function onHighForBotEvent(HighForBotEvent $event)
    {
        if ($this->botIndex !== $event->getInstruction()->getBotIndex()) {
            return;
        }

        if (is_null($this->highValue)) {
            return;
        }

        $instruction = new SetValueInstruction($event->getInstruction()->getHighBotIndex(), $this->highValue);
        $this->dispatcher->dispatch(SetValueEvent::class, new SetValueEvent($instruction));
        $this->highValue = null;
    }

    /**
     * @param LowToOutputEvent $event
     */
    public function onLowToOutputEvent(LowToOutputEvent $event)
    {
        if ($this->botIndex !== $event->getInstruction()->getBotIndex()) {
            return;
        }

        if (is_null($this->lowValue)) {
            return;
        }

        $instruction = new SetValueInstruction($event->getInstruction()->getLowBotIndex(), $this->lowValue);
        $this->dispatcher->dispatch(SetOutputEvent::class, new SetOutputEvent($instruction));
        $this->lowValue = null;
    }

    /**
     * @param HighToOutputEvent $event
     */
    public function onHighToOutputEvent(HighToOutputEvent $event)
    {
        if ($this->botIndex !== $event->getInstruction()->getBotIndex()) {
            return;
        }

        if (is_null($this->highValue)) {
            return;
        }

        $instruction = new SetValueInstruction($event->getInstruction()->getHighBotIndex(), $this->highValue);
        $this->dispatcher->dispatch(SetOutputEvent::class, new SetOutputEvent($instruction));
        $this->highValue = null;
    }

    /**
     * @return int|null
     */
    public function getLowValue()
    {
        return $this->lowValue;
    }

    /**
     * @return int|null
     */
    public function getHighValue()
    {
        return $this->highValue;
    }

    /**
     * @return int|null
     */
    public function getOutputLowValue()
    {
        return $this->outputLowValue;
    }

    /**
     * @return int|null
     */
    public function getOutputHighValue()
    {
        return $this->outputHighValue;
    }
}
