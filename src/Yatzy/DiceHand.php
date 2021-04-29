<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices = [];
    private int $sum;
    private int $nrDices = 0;

    public function roll(): void
    {
        for ($i = 0; $i < $this->nrDices; $i++) {
            $this->dices[$i]->roll();
        }
    }

    public function addDice($dice): void
    {
        $this->dices[$this->nrDices] = $dice;
        $this->nrDices += 1;
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
        for ($i = 0; $i < $this->nrDices; $i++) {
            $res[$i] = $this->dices[$i]->getLastRoll();
        }
        return $res;
    }

    public function getLastRollArrayString(): array
    {
        $res = [];
        for ($i = 0; $i < $this->nrDices; $i++) {
            $res[$i] = $this->dices[$i]->asString();
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

    public function selectDiceGraph($index): void
    {
        $this->dices[$index]->setSides("selected");
    }
}
