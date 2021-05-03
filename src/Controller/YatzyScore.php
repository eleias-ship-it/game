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
class YatzyScore
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION["yatzy"]->score($_POST["choice"]);

        $data = $_SESSION["yatzy"]->getRenderData();

        if ($_SESSION["yatzy"]->getGameOver()) {
            $body = renderView("layout/yatzygameover.php", $data);

            return $psr17Factory
                ->createResponse(200)
                ->withBody($psr17Factory->createStream($body));
        }
        $body = renderView("layout/yatzyplay.php", $data);



        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
