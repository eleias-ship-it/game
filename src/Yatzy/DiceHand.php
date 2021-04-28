<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices;
    private int $sum;
    private string $DiceHandId;
    private int $nrDices;

    public function __construct($diceId, $nrDices = null)
    {
        $this->DiceHandId = $diceId;
        $this->nrDices = $nrDices;

        if ($nrDices > 0) {
            for ($i = 0; $i < $nrDices; $i++) {
                $this->dices[$i] = new Dice();
            }
        }
    }

    public function roll(): void
    {
        for ($i = 0; $i <= $this->nrDices; $i++) {
            $this->dices->roll();
        }
    }

    public function addDice($dices): void
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->dices[$i] = new Dice();
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
}
