<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use elcl20\Dice\Game;

use function Mos\Functions\renderView;

/**
 * Controller for the index route.
 */
class Dice
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION["game"] = new Game();
        $_SESSION["game"]->initScore();
        $_SESSION["game"]->initGame();


        $body = renderView("layout/dice.php", $_SESSION["game"]->gameBody());

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
