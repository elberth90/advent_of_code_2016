<?php

namespace AdventOfCode\D10;

use AdventOfCode\D10\Event\HighForBotEvent;
use AdventOfCode\D10\Event\HighToOutputEvent;
use AdventOfCode\D10\Event\LowForBotEvent;
use AdventOfCode\D10\Event\LowToOutputEvent;
use AdventOfCode\D10\Event\SetValueEvent;
use AdventOfCode\D10\Instruction\Instruction;
use AdventOfCode\D10\Instruction\InstructionFactory;
use AdventOfCode\D10\StreamHandler\StreamHandler;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';

$instructionFactory = new InstructionFactory();
$eventDispatcher = new EventDispatcher();
$botSupervisor = new BotSupervisor($eventDispatcher);
$eventDispatcher->addSubscriber($botSupervisor);

$streamHandler = new StreamHandler($filename, StreamHandler::INIT_FILTER);
foreach ($streamHandler->getLine() as $line) {
    $instruction = $instructionFactory->create($line);
    $eventDispatcher->dispatch(SetValueEvent::class, new SetValueEvent($instruction));
}

$streamHandler = new StreamHandler($filename, StreamHandler::COMMAND_FILTER);
foreach ($streamHandler->getLine() as $line) {
    $instruction = $instructionFactory->create($line);

}

