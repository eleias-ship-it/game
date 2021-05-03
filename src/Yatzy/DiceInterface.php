<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

/**
 * Trait Dice.
 */
interface DiceInterface
{
    public function roll(): ?int;
    public function getLastRoll(): ?int;
    public function asString(): string;
}
