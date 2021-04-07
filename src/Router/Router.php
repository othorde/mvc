<?php

declare(strict_types=1);

namespace Mos\Router;

use phpDocumentor\Reflection\Types\Null_;

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
            return;
        } else if ($method === "GET" && $path === "/gamebegin") {
                $data = [
                "header" => "Dice",
                "message" => "Hey, dice this to do it youreself!",
                ];
                $body = renderView("layout/gamebegin.php", $data);
                sendResponse($body);
                return;
        } else if ($method === "POST" && $path === "/gamebegin") {
            $_POST["kasta"] = "KASTA";

            if (isset($_POST["dice1"])) {
                $nrOfDices = $_POST["dice1"];
                $nrOfDices = intval($nrOfDices);
                $_SESSION["nrOfDices"] = $nrOfDices;
            }

            if (isset($_POST["stop"]) && $_POST["stop"] === "STOP") {
                $nrOfDices = $_SESSION["nrOfDices"];
                $nrOfDices = intval($nrOfDices);
                $callable2 = new \Webbprogrammering\Dice\Game();
                $callable2->playGameComp($nrOfDices);
                $body = renderView("layout/dice.php");
            } else if (isset($_POST["kasta"]) && $_POST["kasta"] === "KASTA") {
                $nrOfDices = $_SESSION["nrOfDices"];
                $callable = new \Webbprogrammering\Dice\Game();
                $callable->playGame($nrOfDices);
                $body = renderView("layout/dice.php");
            }


            if (isset($_POST["reset"]) && $_POST["reset"] === "RESET") {
                echo("HEJ");
                $_SESSION["playerPoints"] = 0;
                $_SESSION["compPoints"] = 0;
                $_SESSION["playerSum"] = 0;
                $_SESSION["compSum"] = 0;
            }
            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
