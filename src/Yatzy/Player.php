<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\DiceHand;

/**
 * Class Dice.
 */
class Player
{
    private array $score = [
        "onlyOnes" => "",
        "onlyTwos" => "",
        "onlyThrees" => "",
        "onlyFours" => "",
        "onlyFives" => "",
        "onlySixes" => "",
        "onePair" => "",
        "twoPair" => "",
        "threes" => "",
        "fourths" => "",
        "smallLadder" => "",
        "bigLadder" => "",
        "fullHouse" => "",
        "Chance" => "",
        "yatzy" => ""
    ];

    private string $name = "";

    private array $settings = [
        "type" => "",
        "nrDices" => 5
    ];

    private Dicehand $diceHand;

    public function __construct(string $type, string $name)
    {
        $type == "human" ? $this->settings["type"] = $type : $this->settings["type"] = $type;

        $this->name = $name;
        $this->diceHand = new DiceHand($this->name, $this->settings["nrDices"]);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getScore(): array
    {
        return $this->score;
    }

    public function roll(): void
    {
        $diceHand->roll();
    }
}
