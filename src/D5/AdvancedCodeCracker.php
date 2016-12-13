<?php

namespace AdventOfCode\D5;

class AdvancedCodeCracker implements CodeCracker
{
    const CODE_NUMBER_IN_HASH = 6;
    const POSITION_IN_HASH = 5;


    /**
     * @var string
     */
    private $doorId;

    /**
     * @var array
     */
    private $code = [];

    /**
     * @param string $doorId
     */
    public function __construct(string $doorId)
    {
        $this->doorId = $doorId;
    }


    /**
     * @inheritdoc
     */
    public function getCode(): string
    {
        for ($i = 0; ; $i++) {
            $hash = md5(sprintf('%s%d', $this->doorId, $i));

            if ($this->isLookingHash($hash)) {
                if ($this->isPositionValid($hash[self::POSITION_IN_HASH])) {
                    $this->code[$hash[self::POSITION_IN_HASH]] = $this->getCodeNumberFromHash($hash);
                }
                if ($this->isCodeCracked()) {
                    break;
                }
            }
        }
        ksort($this->code);

        return implode('', $this->code);
    }

    /**
     * @param string $hash
     *
     * @return bool
     */
    private function isLookingHash(string $hash): bool
    {
        $hash = substr($hash, self::PROPER_BEGINNING_START_FROM, self::PROPER_BEGINNING_LENGTH);

        return false !== strpos($hash, self::PROPER_BEGINNING);
    }

    /**
     * @param string $possiblePosition
     *
     * @return bool
     */
    private function isPositionValid(string $possiblePosition): bool
    {
        return (
            is_numeric($possiblePosition) &&
            !isset($this->code[$possiblePosition]) &&
            $possiblePosition < self::CODE_LENGTH
        );
    }

    /**
     * @param string $hash
     *
     * @return string
     */
    private function getCodeNumberFromHash(string $hash): string
    {
        return $hash[self::CODE_NUMBER_IN_HASH];
    }

    /**
     * @return bool
     */
    private function isCodeCracked(): bool
    {
        return self::CODE_LENGTH === count($this->code);
    }
}
