<?php

require_once 'vendor/autoload.php';

$input = 'cxdnnyjw';

$simpleCracker = new \AdventOfCode\SimpleCodeCracker($input);
echo sprintf("Result for part 1: %s\n", $simpleCracker->getCode());

$advancedCracker = new \AdventOfCode\AdvancedCodeCracker($input);
echo sprintf("Result for part 2: %s\n", $advancedCracker->getCode());
