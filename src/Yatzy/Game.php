<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

use elcl20\Yatzy\Dice;
use elcl20\Yatzy\DiceHand;
use elcl20\Yatzy\GraphicalDice;
use elcl20\Yatzy\Player;

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
    private array $players;
    private int $currentPlayer;
    private array $data;

    public function __construct(string $players, string $bots)
    {
        for ($i = 0; $i < $players; $i++) {
            $this->players[] = new Player("human", "human" . (string)$i);
        }

        for ($u = 0; $u < $bots; $u++) {
            $this->players[count($this->players) + $u] = new Player("bot", "bot" . (string)$u);
        }

        $this->currentPlayer = 0;

        $this->data = [
            "header" => "Yatzy page",
            "message" => "Hello, this is the Yatzyplay page.",
            "players" => $this->getPlayers()
        ];
        // echo "done with construct";
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function newRound(): void
    {
        $this->currentplayer = 0;
    }

    public function nextPlayer(): void
    {
        $this->currentplayer += 1;
    }

    public function getCurrentPlayer(): string
    {
        return $this->players[$this->currentPlayer]->getName();
    }

    public function throw(): void
    {
        $currentPlayer = $this->players[$this->currentPlayer];
        $currentPlayer->roll();
    }

    public function getRenderData(): array
    {
        $data = $this->data;
        $data["gameData"] = $this;
        return $data;
    }
}
