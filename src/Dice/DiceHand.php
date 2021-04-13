<?php

declare(strict_types=1);

namespace elcl20\Dice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

/**
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices;
    private int $sum;
    const DICES = 5;
    private int $nrDices;

    public function __construct(int $nmr = 1)
    {
        $this->nrDices = $nmr;
        $this->sum = 0;

        for ($i = 0; $i <= $this->nrDices; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    public function roll(): void
    {

        for ($i = 0; $i <= $this->nrDices; $i++) {
            $this->sum += $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): int
    {
        $res = 0;
        for ($i = 0; $i <= $this->nrDices; $i++) {
            $res += $this->dices[$i]->getLastRoll();
        }

        return $res;
    }

    public function getLastRollArray(): array
    {
        $res = [];
        for ($i = 0; $i <= $this->nrDices; $i++) {
            $res[$i] = $this->dices[$i]->getLastRoll();
        }
        return $res;
    }

    public function getIndexRoll($index): ?int
    {
        return $this->dices[$index];
    }

    public function getSum(): ?int
    {
        $sum = 0;
        $len = count($this->dices);
        for ($i = 0; $i < $len; $i++) {
            $sum += $this->dices[$i]->getLastRoll();
        }
        return $sum;
    }

    public function rollOne(): void
    {
        $this->dices[count($this->dices)] = new Dice();
        $this->dices[count($this->dices) - 1]->roll();
    }
}
