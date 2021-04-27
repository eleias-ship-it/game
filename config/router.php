<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");


// ----------------------------------------------------------------------------
// game 21 routers
// ----------------------------------------------------------------------------
$router->addRoute("GET", "/dice", "\Mos\Controller\Dice");
$router->addRoute("POST", "/roll1", function () {
    $_SESSION["game"]->addRoll(1);
});
$router->addRoute("POST", "/roll2", function () {
    $_SESSION["game"]->addRoll(2);
});
$router->addRoute("POST", "/stay", function () {
    $_SESSION["game"]->stay();
});
$router->addRoute("POST", "/replay", function () {
    $_SESSION["game"]->initGame();
    $_SESSION["game"]->renderGame();
});

// ----------------------------------------------------------------------------
// Yatzy Game
// ----------------------------------------------------------------------------

$router->addRoute("GET", "/yatzy", "\Mos\Controller\Yatzy");
$router->addRoute("POST", "/startYatzy", "\Mos\Controller\YatzyPlay");


$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});
