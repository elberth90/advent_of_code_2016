<?php

$filename = '../input.txt';
$fp = fopen($filename, 'r');

$save = false;
$marker = '';
//while (($char = fgetc($fp)) !== false) {
//    if ('(' == $char) {
//        $save = true;
//
//    }
//
//    if ($save) {
//        $marker = sprintf('%s%s', $marker, $char);
//    }
//
//    if (')' == $char) {
//        $save = false;
//        var_dump($marker);
//        $marker = '';
//    }
//}

$line = '';
while (($char = fgetc($fp)) !== false) {
    var_dump($char);
    if ('(' !== $char) {
        $line = sprintf('%s%s', $line, $char);
        var_dump($line);
        break;
    }
}

fclose($fp);
