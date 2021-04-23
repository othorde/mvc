<?php

declare(strict_types=1);

namespace Mos\Dice;

use function Mos\Functions\{
    renderView,
    sendResponse
    };

class Game
{
    public function playGame($nrOfDices): void
    {

        $diceHand = new DiceHand($nrOfDices);
        $diceHand->roll();

        $_SESSION["diceHandRollGraph"] = $diceHand->getGraphicalDices();
        $_SESSION["diceHandRoll"] = $diceHand->getLastRoll();
        $_SESSION["playerSum"] += $diceHand->getSum();
        $_SESSION["playerSafe"] = $diceHand->checkNumber($_SESSION["playerSum"]);
        ?>

        <!doctype html>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">

        <?php
        $body = renderView("layout/dice.php", $_SESSION);
        sendResponse($body);
    }

    public function playGameComp($nrOfDices): void
    {

        $diceHandComp = new DiceHand($nrOfDices);

        while ($_SESSION["compSum"] < 21) {
            $diceHandComp->roll();
            $_SESSION["diceHandRollComp"] = $diceHandComp->getLastRoll();
            $_SESSION["compSum"] += $diceHandComp->getSum();
        }
        $_SESSION["playerSafeComp"] = $_SESSION["compSum"];
        if ($_SESSION["compSum"] > 21) {
            $_SESSION["playerPoints"] += 1;
            $_SESSION["comSays"] = "Datorn får mer än 21, du vinner rundan";
        } else if ($_SESSION["compSum"] == 21) {
            if ($_SESSION["playerSum"] == 21) {
                $_SESSION["compPoints"] += 1;
                $_SESSION["PlayerPoints"] -= 1;
                $_SESSION["comSays"] = "Du fick 21, men det fick datorn också, datorn vinner";
            } else if ($_SESSION["playerSum"] != 21) {
                $_SESSION["compPoints"] += 1;
                $_SESSION["comSays"] = "Datorn vinner rundan";
            }
        }

        $_SESSION["playerSum"] = 0;
        $_SESSION["compSum"] = 0;

        $body = renderView("layout/dice.php");
        sendResponse($body);
    }
}
