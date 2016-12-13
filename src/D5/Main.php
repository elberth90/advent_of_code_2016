<?php

use AdventOfCode\D5\AdvancedCodeCracker;
use AdventOfCode\D5\SimpleCodeCracker;

require_once __DIR__ . '/../../vendor/autoload.php';

$input = 'cxdnnyjw';

$simpleCracker = new SimpleCodeCracker($input);
echo sprintf("Result for part 1: %s\n", $simpleCracker->getCode());

$advancedCracker = new AdvancedCodeCracker($input);
echo sprintf("Result for part 2: %s\n", $advancedCracker->getCode());
