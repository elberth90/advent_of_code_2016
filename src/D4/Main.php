<?php

use AdventOfCode\D4\Exceptions\InvalidRoomException;
use AdventOfCode\D4\Room;
use AdventOfCode\D4\RoomHolder;
use AdventOfCode\D4\RotN;

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';

$fp = fopen($filename, "r");
$roomHolder = new RoomHolder();
while (($line = fgets($fp)) !== false) {
    try {
        $roomHolder->add(new Room(trim($line)));
    } catch (InvalidRoomException $e) {
        // ignore it
    }
}
fclose($fp);

echo sprintf("Result for part 1: %s\n", array_sum($roomHolder->getRoomIdsList()));


foreach ($roomHolder->getRoomsList() as $room) {
    $roomName = str_replace('-', ' ', $room->getEncryptedName());
    $decryptedRoomName =  strtolower(RotN::rot($roomName, $room->getSectorId()));
    if (false !== strpos($decryptedRoomName, 'north') && false !== strpos($decryptedRoomName, 'pole')) {
        echo sprintf("Result for part 2: %s\n", $room->getSectorId());
        break;
    }
}
