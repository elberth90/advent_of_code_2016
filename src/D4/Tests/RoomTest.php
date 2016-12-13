<?php

namespace AdventOfCode\D4\Tests;

use AdventOfCode\D4\Exceptions\InvalidRoomException;
use AdventOfCode\D4\Room;

class RoomTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider roomProvider
     */
    public function test_that_Room_object_can_be_properly_created($roomData, $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvalidRoomException::class);
        }

        new Room($roomData);
    }

    /**
     * @return array
     */
    public function roomProvider(): array
    {
        return [
            [
                '$roomData' => 'aaaaa-bbb-z-y-x-123[abxyz]',
                '$isValid' => true,
            ],
            [
                '$roomData' => 'a-b-c-d-e-f-g-h-987[abcde]',
                '$isValid' => true,
            ],
            [
                '$roomData' => 'not-a-real-room-404[oarel]',
                '$isValid' => true,
            ],
            [
                '$roomData' => 'totally-real-room-200[decoy]',
                '$isValid' => false,
            ],
        ];
    }
}
