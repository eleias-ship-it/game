<?php

declare(strict_types=1);

namespace elcl20\Dice;

use elcl20\Dice\Dice;
use elcl20\Dice\DiceHand;
use elcl20\Dice\GraphicalDice;

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
    private $graphDice;
    private $die;
    private $diceHand;
    private $computerHand;

    private array $data = [];

    public function initScore(): void
    {
        $_SESSION["scoreHuman"] = 0;
        $_SESSION["scoreComputer"] = 0;
    }

    public function initGame(): void
    {
        $this->die = new Dice();
        $this->diceHand = new DiceHand();
        $this->graphDice = new GraphicalDice();

        $this->die->roll();
        $this->diceHand->roll();
        $this->diceHand->roll();

        $this->data["lastRollSide"] = null;
        $this->data["HandGraph0"] = null;
        $this->data["HandGraph1"] = null;
        $this->data["computerHand"] = null;
        $this->data["gameOver"] = null;

        $this->data["dieLastRoll"] = $this->die->getLastRoll();
        $this->data["diceHandRoll"] = $this->diceHand->getLastRoll();
        $this->data["diceHandRoll1"] = $this->diceHand->getLastRoll();
        $this->data["sum"] = 0;
        $this->data["computerSum"] = 0;
        $this->data["diceArea"] = "hidden";
        $this->data["buttonArea"] = "button-area";
        $this->data["playButton"] = "hidden";
        $this->data["endScreen"] = "hidden";
    }

    public function renderGame(): void
    {
        $this->data["header"] = "Dice page";
        $this->data["message"] = "play dice game";
        $header = $header ?? null;
        $message = $message ?? null;

        $body = renderView("layout/dice.php", $this->data);
        sendResponse($body);
    }

    public function addRoll(int $nmr): void
    {
        $this->data["diceArea"] = "dice-area";
        if ($nmr == 1) {
            $this->die->roll();
            $this->data["dieLastRoll"] = $this->die->getLastRoll();
            $this->data["sum"] += $this->die->getLastRoll();
            $this->data["lastRollSide"] = $this->graphDice->getSide($this->die->getLastRoll() - 1);
            $this->data["HandGraph0"] = null;
            $this->data["HandGraph1"] = null;
        } elseif ($nmr == 2) {
            $this->diceHand->roll();
            $this->data["diceHandRoll"] = $this->diceHand->getLastRoll();
            $this->data["sum"] += $this->diceHand->getSum();

            $lastHandRolls = $this->diceHand->getLastRollArray();
            $len = count($lastHandRolls);
            for ($i = 0; $i < $len; $i++) {
                $this->data["HandGraph" . (string)$i] = $this->graphDice->getSide((int)$lastHandRolls[$i] - 1);
            }
            $this->data["lastRollSide"] = null;
        }

        if ($this->data["sum"] == 21) {
            $this->stay();
        } elseif ($this->data["sum"] > 21) {
            $this->data["gameOver"] = "you are fat.";
            $this->loser();
        }

        $body = renderView("layout/dice.php", $this->data);
        sendResponse($body);
    }

    public function stay(): void
    {
        $this->computerHand = new DiceHand();
        $this->computerHand->rollOne();
        $this->data["computerHand"] = $this->computerHand->getLastRoll();
        $this->data["computerSum"] += $this->computerHand->getSum();

        while ($this->data["computerSum"] <= 21 && $this->data["computerSum"] <= $this->data["sum"]) {
            $this->computerHand->rollOne();
            $this->data["computerSum"] += $this->computerHand->getSum();
        }

        if ($this->data["computerSum"] == 21) {
            $this->data["gameOver"] = "computer got 21, you lost.";
            $this->loser();
        } elseif ($this->data["computerSum"] > 21) {
            $this->data["gameOver"] = "computer is fat, you win.";
            $this->winner();
        } elseif ($this->data["computerSum"] >= $this->data["sum"]) {
            $this->data["gameOver"] = "computer rolled higher, you loose.";
            $this->loser();
        }

        $body = renderView("layout/dice.php", $this->data);
        sendResponse($body);
    }

    public function winner(): void
    {
        $this->data["diceArea"] = "hidden";
        $this->data["endScreen"] = "winner";
        $_SESSION["scoreHuman"] += 1;
        $this->fixButtons();
    }

    public function loser(): void
    {
        $this->data["diceArea"] = "hidden";
        $this->data["endScreen"] = "loser";
        $_SESSION["scoreComputer"] += 1;
        $this->fixButtons();
    }

    public function fixButtons(): void
    {
        $this->data["buttonArea"] = "hidden";
        $this->data["playButton"] = "button-area";
    }
}
