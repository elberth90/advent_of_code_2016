<?php

namespace AdventOfCode\D4;

use AdventOfCode\D4\Exceptions\InvalidRoomException;

class Room
{
    const SPLIT = '|-(\d+)|';
    const PREG_SPLIT_LIMIT = -1;

    /**
     * @var string
     */
    private $encryptedName;

    /**
     * @var int
     */
    private $sectorId;

    /**
     * @var string
     */
    private $checksum;

    /**
     * Room constructor.
     */
    public function __construct(string $roomData)
    {
        $this->extractData($roomData);
        if (!$this->isValid()) {
            throw new InvalidRoomException();
        }
    }

    /**
     * @param string $roomData
     */
    private function extractData(string $roomData)
    {
        list($this->encryptedName, $this->sectorId, $this->checksum) = preg_split(
            self::SPLIT,
            $roomData,
            self::PREG_SPLIT_LIMIT,
            PREG_SPLIT_DELIM_CAPTURE
        );
    }

    /**
     * @return bool
     */
    private function isValid(): bool
    {
        return $this->checksum === $this->calculateChecksum();
    }

    /**
     * @return string
     */
    private function calculateChecksum(): string
    {
        $charCount = count_chars(str_replace('-', '', $this->encryptedName), 1);
        $charCount = $this->sortByValueAndKey($charCount);

        $checksum = array_reduce(array_keys(array_slice($charCount, 0, 5, true)), function ($carry, $item) {
            return sprintf('%s%s', $carry, chr($item));
        }, '');

        return sprintf('[%s]', $checksum);
    }

    /**
     * @param array $arr
     *
     * @return array
     */
    private function sortByValueAndKey($arr): array
    {
        $keys = array_keys($arr);
        array_multisort(
            array_values($arr), SORT_DESC, SORT_NUMERIC, $arr, $keys
        );

        return array_combine($keys, $arr);
    }

    /**
     * @return int
     */
    public function getSectorId(): int
    {
        return $this->sectorId;
    }

    /**
     * @return string
     */
    public function getEncryptedName(): string
    {
        return $this->encryptedName;
    }
}
