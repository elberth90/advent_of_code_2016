<?php

namespace AdventOfCode\Tests;

use AdventOfCode\Room;
use AdventOfCode\RoomHolder;

class RoomHolderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider roomProvider
     */
    public function test_that_RoomHolder_can_return_ids_of_all_rooms($rooms, $expectedRoomIds)
    {
        $holder = new RoomHolder();
        foreach ($rooms as $room) {
            $holder->add($room);
        }

        $this->assertEquals($expectedRoomIds, $holder->getRoomIdsList());
    }

    /**
     * @dataProvider roomProvider
     */
    public function test_that_RommHolder_can_return_Generator($rooms)
    {
        $holder = new RoomHolder();
        foreach ($rooms as $room) {
            $holder->add($room);
        }

        $roomList = $holder->getRoomsList();

        $this->assertInstanceOf(\Generator::class, $roomList);
        foreach ($rooms as $room) {
            $this->assertEquals($room, $roomList->current());
            $roomList->next();
        }
    }

    /**
     * @return array
     */
    public function roomProvider(): array
    {
        return [
            [
                '$rooms' => [
                    new Room('aaaaa-bbb-z-y-x-123[abxyz]'),
                    new Room('a-b-c-d-e-f-g-h-987[abcde]'),
                    new Room('not-a-real-room-404[oarel]'),
                ],
                '$expectedRoomIds' => [123, 987, 404],
            ],
        ];
    }
}
