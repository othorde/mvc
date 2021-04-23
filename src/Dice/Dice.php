<?php

declare(strict_types=1);

namespace Mos\Dice;

/* use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
}; */

/**
 * Class Dice.
 */
class Dice
{
    private ?int $roll = null;
    private ?int $faces = null;

    public function __construct(int $faces)
    {
        $this->faces = $faces;
    }

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);
        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
