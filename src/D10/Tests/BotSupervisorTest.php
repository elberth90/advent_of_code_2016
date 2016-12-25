<?php

namespace AdventOfCode\D10\Tests;

use AdventOfCode\D10\Bot;
use AdventOfCode\D10\BotSupervisor;
use AdventOfCode\D10\Event\SetValueEvent;
use AdventOfCode\D10\Instruction\SetValueInstruction;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * @property BotSupervisor   supervisor
 * @property EventDispatcher dispatcher
 */
class BotSupervisorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->dispatcher = new EventDispatcher();
        $this->supervisor = new BotSupervisor($this->dispatcher);

        $this->dispatcher->addSubscriber($this->supervisor);
    }

    public function test_that_supervisor_can_initialize_new_bot()
    {
        $beforeSize = $this->supervisor->size();
        $this->dispatcher->dispatch(SetValueEvent::class, new SetValueEvent(new SetValueInstruction(1, 2)));
        $this->assertEquals($beforeSize + 1, $this->supervisor->size());
        $this->assertInstanceOf(Bot::class, $this->supervisor->getBot(1));
        $this->dispatcher->dispatch(SetValueEvent::class, new SetValueEvent(new SetValueInstruction(2, 3)));
        $this->assertEquals($beforeSize + 2, $this->supervisor->size());
        $this->assertInstanceOf(Bot::class, $this->supervisor->getBot(2));
    }
}
