<?php

declare(strict_types=1);

namespace Mos\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class ControllerGameTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game(2);
        $this->assertInstanceOf("\Mos\Dice\Game", $controller);
    }

    public function testPlayGame()
    {
        $controller = new Game();
        $_SESSION["diceHandRollGraph"] = 0;
        $_SESSION["diceHandRoll"] = 0;
        $_SESSION["playerSum"] = 0;
        $_SESSION["playerSafe"] = 0;
        $controller->playGame(2);

        $this->assertInstanceOf("\Mos\Dice\Game", $controller);
        $this->assertNotEquals($_SESSION["diceHandRollGraph"], 0);
        $this->assertNotEquals($_SESSION["diceHandRoll"], 0);
        $this->assertNotEquals($_SESSION["playerSum"], 0);
        $this->assertNotEquals($_SESSION["playerSafe"], 0);
    }

    public function testPlayGameComp()
    {
        $controller = new Game();
        $_SESSION["compSum"] = 0;
        $_SESSION["diceHandRollComp"] = 0;
        $_SESSION["comSays"] = 0;
        $_SESSION["compPoints"] = 22;
        $_SESSION["playerPoints"] = 0;
        $controller->playGameComp(2);
        $this->assertEquals($_SESSION["comSays"], "Datorn får mer än 21, du vinner rundan");

        $_SESSION["PlayerPoints"] = 21;
        $_SESSION["compSum"] = 21;
        $_SESSION["diceHandRollComp"] = 0;
        $_SESSION["comSays"] = 0;
        $_SESSION["compPoints"] = 0;
        $_SESSION["playerSum"] = 21;

        $controller->playGameComp(2);
        $this->assertEquals($_SESSION["comSays"], "Du fick 21, men det fick datorn också, datorn vinner");

        $_SESSION["PlayerPoints"] = 21;
        $_SESSION["compSum"] = 21;
        $_SESSION["diceHandRollComp"] = 0;
        $_SESSION["comSays"] = 0;
        $_SESSION["compPoints"] = 0;
        $_SESSION["playerSum"] = 20;

        $controller->playGameComp(2);
        $this->assertEquals($_SESSION["comSays"], "Datorn vinner rundan");
    }
}
