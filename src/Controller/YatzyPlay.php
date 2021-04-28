<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use elcl20\Yatzy\Game;

use function Mos\Functions\renderView;

/**
 * Controller for the YatzyPlay route.
 */
class YatzyPlay
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        // isset($_SESSION["yatzy"]) ? $_SESSION["yatzy"]->throw() : $_SESSION["yatzy"] = new Game($_POST["players"], $_POST["bots"]);

        if (isset($_SESSION["yatzy"]) == 1) {
            $_SESSION["yatzy"]->throw();
        } else {
            $_SESSION["yatzy"] = new Game($_POST["players"], $_POST["bots"]);
        }


        $data = $_SESSION["yatzy"]->getRenderData();

        $body = renderView("layout/yatzyplay.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
