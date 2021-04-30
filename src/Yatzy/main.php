<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use elcl20\Yatzy\Dice;

$allDices = [0, 1, 2, 3, 4];
$array1 = [1, 2];

foreach ($array1 as $key => $value) {
    if (in_array($value, $allDices)) {
            unset($allDices[$value]);
    }
}

var_dump($allDices);
// array(2) { [0]=> int(2) [1]=> int(4) }
// array(5) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(0) [4]=> int(4) }
