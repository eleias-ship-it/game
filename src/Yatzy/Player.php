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

    public function getSettings(): array
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

    public function rollOne($index): void
    {
        $this->diceHand->rollOne($index);
    }

    public function getLastRoll(): array
    {
        return $this->diceHand->getLastRollArray();
    }
    public function getLastRollString(): array
    {
        return $this->diceHand->getLastRollArrayString();
    }

    public function clickDice($index): bool
    {
        $this->diceHand->selectDiceGraph($index);

        foreach ($this->settings["savedDice"] as $key => $value) {
            if ((integer) $index == $value) {
                array_splice($this->settings["savedDice"], $key, 1);
                return false;
            }
        }

        array_push($this->settings["savedDice"], (integer)($index));

        return true;

    }
}
