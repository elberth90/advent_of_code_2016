<?php

namespace AdventOfCode\D5;

class SimpleCodeCracker implements CodeCracker
{
    const CODE_NUMBER_IN_HASH = 5;

    /**
     * @var string
     */
    private $doorId;

    /**
     * @var string
     */
    private $code = '';

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
                $this->code = sprintf('%s%s', $this->code, $this->getCodeNumberFromHash($hash));
                if ($this->isCodeCracked()) {
                    break;
                }
            }
        }

        return $this->code;
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
        return self::CODE_LENGTH === strlen($this->code);
    }
}
