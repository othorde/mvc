<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use phpDocumentor\Reflection\Types\Callable_;
use Psr\Http\Message\ResponseInterface;
use Mos\Dice\YatzyGame as YatzyGame;

use function Mos\Functions\renderView;
use function Mos\Functions\destroySession;

/**
* Controller for showing how Twig views works.
*/

class Yatzy
{
    public function index(): ResponseInterface #ska det vara index eller invoke?
    {
        $nrOfDice = 5;
        $game = new YatzyGame($nrOfDice);
        $_SESSION["yatzygame"] = $game;
        $psr17Factory = new Psr17Factory();
        $data = [
            "header" => "Yatzy 0.2 ",
            "message" => "Hej! <br> Spela spelet genom att kasta tärningen. <br>
            Välj vilka tärningar du vill spara genom att markera dem.",
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function index2(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Yatzy 0.2 ",
            "message" => "Hej! <br> Spela spelet genom att kasta tärningen. <br>
            Välj vilka tärningar du vill spara genom att markera dem.",
        ];

        if (isset($_POST["reset"]) && $_POST["reset"] === "RESET") {
            destroySession();
        }

        if (!isset($_SESSION["throws"])) {
            $_SESSION["throws"] = 1;
            $_SESSION["round"] = 1;
        } else if (isset($_SESSION["throws"])) {
            $_SESSION["throws"] += 1;
            if ($_SESSION["throws"] == 4) {
                $_SESSION["throws"] = 1;
                $_SESSION["round"] += 1;
            }
        }

        $body = renderView("layout/yatzy.php", $data);
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
