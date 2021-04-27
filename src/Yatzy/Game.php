<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\Dice;
use elcl20\Yatzy\DiceHand;
use elcl20\Yatzy\GraphicalDice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Class Game.
 */
class Game
{
    private $name;

    public function __construct(string $aname)
    {
        $this->name = $aname;

        var_dump($this->name);
    }
}
