<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Mos\Dice\Game as Game;

use function Mos\Functions\renderView;

/**
 * Controller for showing how Twig views works.
 */
class GameBeginPost
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_POST["kasta"] = "KASTA";

        if (isset($_POST["dice1"])) {
            $nrOfDices = $_POST["dice1"];
            $nrOfDices = intval($nrOfDices);
            $_SESSION["nrOfDices"] = $nrOfDices;
        }

        if (isset($_POST["stop"]) && $_POST["stop"] === "STOP") {
            $nrOfDices = $_SESSION["nrOfDices"];
            $nrOfDices = intval($nrOfDices);
            $callable2 = new Game();
            $callable2->playGameComp($nrOfDices);
            $body = renderView("layout/dice.php");
        } else if (isset($_POST["kasta"]) && $_POST["kasta"] === "KASTA") {
            $nrOfDices = $_SESSION["nrOfDices"];
            $callable = new Game();
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
        $data = [
            "header" => "Twig page",
            "message" => "Hey, edit this to do it youreself!",
        ];

        $body = renderView("layout/page.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
/* } else if ($method === "GET" && $path === "/dice") {
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
    } */
