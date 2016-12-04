<?php

namespace AdventOfCode;

class RoomHolder
{
    /**
     * @var array
     */
    private $roomList = [];

    /**
     * @param Room $room
     */
    public function add(Room $room)
    {
        $this->roomList[] = $room;
    }

    /**
     * @return array
     */
    public function getRoomIdsList(): array
    {
        return array_map(function (Room $room) {
            return $room->getSectorId();
        }, $this->roomList);
    }

    /**
     * @return \Generator|Room[]
     */
    public function getRoomsList(): \Generator
    {
        foreach ($this->roomList as $room) {
            yield $room;
        }
    }
}
