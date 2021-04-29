<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\DiceHand;
use elcl20\Yatzy\Dice;
use elcl20\Yatzy\GraphicalDice;

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
        "nrDices" => 5,
        "savedDice" => []
    ];

    private Dicehand $diceHand;

    public function __construct(string $type, string $name)
    {
        $type == "human" ? $this->settings["type"] = $type : $this->settings["type"] = $type;
        $this->name = $name;

        $this->diceHand = new DiceHand();

        for ($i=0; $i < $this->settings["nrDices"]; $i++) {
            $this->diceHand->addDice(new GraphicalDice());
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSettings(): string
    {
        return $this->settings;
    }

    public function getScore(): array
    {
        return $this->score;
    }

    public function roll(): void
    {
        $this->diceHand->roll();
    }

    public function getLastRoll(): array
    {
        return $this->diceHand->getLastRollArray();
    }
    public function getLastRollString(): array
    {
        return $this->diceHand->getLastRollArrayString();
    }

    public function clickDice($index): void
    {
        // var_dump($index);
        // array_push($this->settings["savedDice"], (integer)($index));
        $this->diceHand->selectDiceGraph($index);
        // var_dump($this->settings);
    }
}
