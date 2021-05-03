<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\CommonTrait;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Dice.
 */
class GraphicalDice extends Dice
{
    use CommonTrait;

    private array $sides;
    private $status = "";

    public function __construct()
    {
        $this->sides = $this->getGraphDiceSide("");
    }

    public function reset(): void
    {
        $this->roll = 1;
        $this->status = "";
        $this->sides = $this->getGraphDiceSide("");
    }

    public function asString(): string
    {
        return $this->sides[$this->getLastRoll() - 1];
    }

    public function setSides($status): void
    {
        if ($this->status == "") {
            $this->status = $status;
            $this->sides = $this->getGraphDiceSide($status);
        } elseif ($this->status == $status) {
            $this->status = "";
            $this->sides = $this->getGraphDiceSide("");
        }
    }
}
