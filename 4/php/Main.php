<?php

require_once __DIR__ . '/vendor/autoload.php';

$filename = '../input.txt';
$fp = fopen($filename, "r");
$roomHolder = new \AdventOfCode\RoomHolder();
while (($line = fgets($fp)) !== false) {
    try {
        $roomHolder->add(new \AdventOfCode\Room(trim($line)));
    } catch (\AdventOfCode\Exceptions\InvalidRoomException $e) {
        // ignore it
    }
}
fclose($fp);

echo sprintf("Result for part 1: %s\n", array_sum($roomHolder->getRoomIdsList()));


foreach ($roomHolder->getRoomsList() as $room) {
    $roomName = str_replace('-', ' ', $room->getEncryptedName());
    $decryptedRoomName =  strtolower(\AdventOfCode\RotN::rot($roomName, $room->getSectorId()));
    if (false !== strpos($decryptedRoomName, 'north') && false !== strpos($decryptedRoomName, 'pole')) {
        echo sprintf("Result for part 2: %s\n", $room->getSectorId());
        break;
    }
}
