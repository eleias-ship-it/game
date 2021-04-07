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
    public function playGame(): void
    {
        $data = [
            "header" => "Dice page",
            "message" => "play dice game",
        ];


        $header = $header ?? null;
        $message = $message ?? null;


        $diceSide = new GraphicalDice();
        $die = new Dice();
        $diceHand = new DiceHand();

        $die->roll();
        $diceHand->roll();
        $diceHand->roll();


        $data["lastRollSide"] = $diceSide->getSide($die->getLastRoll() - 1);


        $data["dieLastRoll"] = $die->getLastRoll();
        $data["diceHandRoll"] = $diceHand->getLastRoll();
        $data["diceHandRoll1"] = $diceHand->getLastRoll();

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);

    }

}
