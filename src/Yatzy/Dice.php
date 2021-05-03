<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\DiceInterface;

/**
 *
 */
// interface DiceInterface
// {
//     public function roll(): ?int;
//     public function getLastRoll(): ?int;
//     public function asString(): string;
// }


/**
 * Class Dice.
 */
class Dice implements DiceInterface
{
    const FACES = 6;

    private ?int $roll = 1;

    public function reset(): void
    {
        $this->roll = 1;
    }

    public function roll(): ?int
    {
        $this->roll = rand(1, self::FACES);

        return $this->roll;
    }

    public function getLastRoll(): ?int
    {
        return $this->roll;
    }

    public function asString(): string
    {
        return (string) $this->roll;
    }
}
