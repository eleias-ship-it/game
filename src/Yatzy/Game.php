<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\Dice;
use elcl20\Yatzy\DiceHand;
use elcl20\Yatzy\GraphicalDice;
use elcl20\Yatzy\Player;
use elcl20\Yatzy\CommonTrait;

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
    use CommonTrait;

    private array $players;
    private int $currentPlayer;
    private array $data;
    private int $throwsThisRound = 0;
    private int $maxGameRounds = 0;
    private int $roundCounter = 1;
    private bool $gameOver = false;

    public function __construct(string $players, string $bots)
    {
        for ($i = 0; $i < $players; $i++) {
            $this->players[] = new Player("human", "human" . (string)$i);
        }

        for ($u = 0; $u < $bots; $u++) {
            $this->players[count($this->players) + $u] = new Player("bot", "bot" . (string)$u);
        }

        $this->currentPlayer = 0;
        $this->maxGameRounds = count($this->players) * 15;

        $this->data = [
            "header" => "Yatzy page",
            "message" => "Hello, this is the Yatzyplay page.",
            "players" => $this->getPlayers(),
            "throw" => "button"
        ];

    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function newRound(): void
    {
        $this->data["throw"] = "button";

        if ($this->roundCounter == $this->maxGameRounds) {
            $this->gameOver();
        }

        foreach ($this->players as $player) {
            $player->resetSaves();
        }
        if ($this->currentPlayer == count($this->players) - 1) {
            $this->currentPlayer = 0;
        } else {
            $this->currentPlayer += 1;
        }

        $this->roundCounter += 1;
        $this->throwsThisRound = 0;
    }

    public function nextPlayer(): void
    {
        $this->currentPlayer += 1;
    }

    public function getGameOver(): bool
    {
        return $this->gameOver;
    }

    public function getCurrentPlayer(): string
    {
        return $this->players[$this->currentPlayer]->getName();
    }

    public function throw(): void
    {
        $this->data["throw"] = "submit";

        // quick fix to get the dices to be thrown->
        $allDices = [0, 1, 2, 3, 4];

        $currentPlayer = $this->players[$this->currentPlayer];

        if ($this->throwsThisRound < 1) {
            $currentPlayer->roll();
        } elseif ($this->throwsThisRound < 2) {
            // check saves and construct the array with dices to be throwed
            foreach ($currentPlayer->getSettings()["savedDice"] as $value) {
                if (in_array($value, $allDices)) {
                    unset($allDices[$value]);
                }
            }

            foreach ($allDices as $value) {
                $currentPlayer->rollOne($value);
            }
        }
        $this->throwsThisRound += 1;

        if ($this->throwsThisRound == 2) {
            // remove throw button
            // render table to be hoovered and clickabel
        }
    }

    public function click(): void
    {
        $this->players[$this->currentPlayer]->clickDice($_POST["dice"]);
    }

    public function getRenderData(): array
    {
        // var_dump($this->currentPlayer);
        $data = $this->data;
        $data["gameData"] = $this;
        $data["currentPlayerInt"] = $this->currentPlayer;
        // $data["lastThrow"] = $this->players[$this->currentPlayer]->getLastRoll();
        $data["lastThrowGraphical"] = $this->players[$this->currentPlayer]->getLastRollString();
        $data["playerSettings"] = $this->players[$this->currentPlayer]->getSettings();

        return $data;
    }

    public function getPlayerData(): void
    {
        $playerData = [];
        foreach ($this->players as $key => $value) {
            $playerData[$value->getName()] = $value->getSettings();
        }
    }

    public function score($choice): int
    {
        // check if storeable, else message "cant store that option"

        $currentRolls = $this->players[$this->currentPlayer]->getLastRoll();
        $rollsHistogram = $this->arrayToHist($currentRolls);
        $score = 0;

        switch ($choice) {
            case "onlyOnes":
                $score = $this->onlyN($rollsHistogram, 1);
                break;
            case "onlyTwos":
                $score = $this->onlyN($rollsHistogram, 2);
                break;
            case "onlyThrees":
                $score = $this->onlyN($rollsHistogram, 3);
                break;
            case "onlyFours":
                $score = $this->onlyN($rollsHistogram, 4);
                break;
            case "onlyFives":
                $score = $this->onlyN($rollsHistogram, 5);
                break;
            case "onlySixes":
                $score = $this->onlyN($rollsHistogram, 6);
                break;
            case "yatzy":
                $score = $this->yatzy($rollsHistogram);
                break;
            case "Chance":
                $score = $this->chance($rollsHistogram);
                break;
            case "onePair":
                $score = $this->onePair($rollsHistogram);
                break;
            case "twoPair":
                $score = $this->twoPair($rollsHistogram);
                break;
            case "threes":
                $score = $this->threes($rollsHistogram);
                break;
            case "fourths":
                $score = $this->fourths($rollsHistogram);
                break;
            case "smallLadder":
                $score = $this->smallLadder($rollsHistogram);
                break;
            case "bigLadder":
                $score = $this->bigLadder($rollsHistogram);
                break;
            case "fullHouse":
                $score = $this->fullHouse($rollsHistogram);
                break;
            default:
                // strike a score row.
                if (substr($choice, 0, 4) == "pass") {
                    $choice = explode(" ", $choice);
                    $this->players[$this->currentPlayer]->setScore($score, $choice[1]);
                    $this->newRound();
                    return 1;
                }

                break;
        }


        // add $score to gamestats
        if ($score == 0) {
            // set message: cant do that
            $this->data["message"] = "That choice does not give any score.";
            return 0;
        }

        if ($this->players[$this->currentPlayer]->setScore($score, $choice)) {
            $this->newRound();
            return 1;
        }

        $this->data["message"] = "That choice does not give any score.";
        return 1;
    }

    public function gameOver(): void
    {
        $this->gameOver = true;
        $finalScore = [];

        foreach ($this->players as $player) {

            $playerScore = $player->getScore();
            $score = 0;

            foreach ($playerScore as $v) {
                $score += (integer)$v;
            }

            $finalScore[$player->getName()] = $score;
            // var_dump($playerScore);
        }

        $this->data["finalScore"] = $finalScore;
        $this->data["winner"] = array_search(max($finalScore), $finalScore);
    }
}
