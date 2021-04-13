<?php

declare(strict_types=1);

namespace Mos\Router;

use elcl20\Dice\Game;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    private array $callable;

    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $_SESSION["game"] = new Game();
            $_SESSION["game"]->initScore();
            $_SESSION["game"]->initGame();
            $_SESSION["game"]->renderGame();

            return;
        } else if ($method === "POST" && $path === "/roll1") {
            $_SESSION["game"]->addRoll(1);

            return;
        } else if ($method === "POST" && $path === "/roll2") {
            $_SESSION["game"]->addRoll(2);

            return;
        } else if ($method === "POST" && $path === "/stay") {
            $_SESSION["game"]->stay();

            return;
        } else if ($method === "POST" && $path === "/replay") {
            $_SESSION["game"]->initGame();
            $_SESSION["game"]->renderGame();

            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
    //Set the person's name.
    public function setGame(): void
    {
        $this->callable["game"] = new Game();
        $this->callable["game"]->initGame();
        $this->callable["game"]->renderGame();
    }

    public function getGame(): void
    {
        return;
    }
}
