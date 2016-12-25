<?php

namespace AdventOfCode\D10\Tests;

use AdventOfCode\D10\Bot;
use AdventOfCode\D10\Event\CommandEvent;
use AdventOfCode\D10\Event\HighForBotEvent;
use AdventOfCode\D10\Event\HighToOutputEvent;
use AdventOfCode\D10\Event\LowForBotEvent;
use AdventOfCode\D10\Event\LowToOutputEvent;
use AdventOfCode\D10\Event\SetOutputEvent;
use AdventOfCode\D10\Event\SetValueEvent;
use AdventOfCode\D10\Instruction\CommandInstruction;
use AdventOfCode\D10\Instruction\HighForBotInstruction;
use AdventOfCode\D10\Instruction\HighToOutputInstruction;
use AdventOfCode\D10\Instruction\LowForBotInstruction;
use AdventOfCode\D10\Instruction\LowToOutputInstruction;
use AdventOfCode\D10\Instruction\SetValueInstruction;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @property Bot                                                        bot
 * @property EventDispatcher                                            dispatcher
 * @property int                                                        botIndex
 * @property \Prophecy\Prophecy\ObjectProphecy|EventDispatcherInterface dispatcherMock
 */
class BotTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->botIndex = 1;
        $this->dispatcher = new EventDispatcher();
        $this->dispatcherMock = $this->prophesize(EventDispatcherInterface::class);
        $this->bot = new Bot(
            $this->botIndex,
            $this->dispatcherMock->reveal()
        );

        $this->dispatcher->addSubscriber($this->bot);
    }

    public function test_bot_set_value()
    {
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 4)));
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 2)));
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction(99, 3)));
        $this->assertEquals(2, $this->bot->getLowValue());
        $this->assertEquals(4, $this->bot->getHighValue());
    }

    public function test_bot_set_output()
    {
        $this->dispatcher->dispatch(SetOutputEvent::class,
            new SetOutputEvent(new SetValueInstruction($this->botIndex, 4)));
        $this->dispatcher->dispatch(SetOutputEvent::class,
            new SetOutputEvent(new SetValueInstruction($this->botIndex, 2)));
        $this->dispatcher->dispatch(SetOutputEvent::class,
            new SetOutputEvent(new SetValueInstruction(99, 3)));
        $this->assertEquals(2, $this->bot->getOutputLowValue());
        $this->assertEquals(4, $this->bot->getOutputHighValue());
    }

    public function test_bot_can_send_low_value_to_bot()
    {
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 4)));
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 2)));

        $this->dispatcherMock->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction(99, 2)))->shouldBeCalled();

        $this->dispatcher->dispatch(LowForBotEvent::class,
            new LowForBotEvent(new LowForBotInstruction($this->botIndex, 99)));
    }

    public function test_bot_can_send_high_value_to_bot()
    {
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 4)));
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 2)));

        $this->dispatcherMock->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction(99, 4)))->shouldBeCalled();

        $this->dispatcher->dispatch(HighForBotEvent::class,
            new HighForBotEvent(new HighForBotInstruction($this->botIndex, 99)));
    }

    public function test_bot_can_send_low_value_to_bot_output()
    {
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 4)));
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 2)));

        $this->dispatcherMock->dispatch(SetOutputEvent::class,
            new SetOutputEvent(new SetValueInstruction(99, 2)))->shouldBeCalled();

        $this->dispatcher->dispatch(LowToOutputEvent::class,
            new LowToOutputEvent(new LowToOutputInstruction($this->botIndex, 99)));
    }

    public function test_bot_can_send_high_value_to_bot_output()
    {
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 4)));
        $this->dispatcher->dispatch(SetValueEvent::class,
            new SetValueEvent(new SetValueInstruction($this->botIndex, 2)));

        $this->dispatcherMock->dispatch(SetOutputEvent::class,
            new SetOutputEvent(new SetValueInstruction(99, 4)))->shouldBeCalled();

        $this->dispatcher->dispatch(HighToOutputEvent::class,
            new HighToOutputEvent(new HighToOutputInstruction($this->botIndex, 99)));
    }

//    public function test_bot_give_value()
//    {
//        $this->dispatcher->dispatch(SetValueEvent::class,
//            new SetValueEvent(new SetValueInstruction($this->botIndex, 4)));
//        $this->dispatcher->dispatch(SetValueEvent::class,
//            new SetValueEvent(new SetValueInstruction($this->botIndex, 2)));
//
//        $this->dispatcherMock->dispatch(SetValueEvent::class,
//            new SetValueEvent(new SetValueInstruction(99, 2)))->shouldBeCalled();
//        $this->dispatcherMock->dispatch(SetValueEvent::class,
//            new SetValueEvent(new SetValueInstruction(999, 4)))->shouldBeCalled();
//
//        $this->dispatcher->dispatch(CommandEvent::class, new CommandEvent(new CommandInstruction($this->botIndex, 99, 999)));
//        $this->assertEquals(null, $this->bot->getLowValue());
//        $this->assertEquals(null, $this->bot->getHighValue());
//    }
}
