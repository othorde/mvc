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
$router->addRoute("GET", "/gamebegin", "\Mos\Controller\GameBegin"); /* Ny */
$router->addRoute("POST", "/gamebegin", "\Mos\Controller\GameBeginPost"); /* Ny */
/*
$router->addRoute("GET", "/yatzy", "\Mos\Controller\Yatzy");
$router->addRoute("POST", "/yatzy", "\Mos\Controller\Yatzy");
*/


$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Yatzy", "index"]);
    $router->addRoute("POST", "", ["\Mos\Controller\Yatzy", "index2"]); //ska de va index på bägge?
});


$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});
