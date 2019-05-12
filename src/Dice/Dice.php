<?php
namespace ARWeb\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class Dice
{
    /**
     * @var int $dices How many dices.
     * @var int  $lastRoll Last roll value.
     * @var integer SIDES Number of sides of the Dice.
     */
    private $lastRoll;
    private $sides = 6;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct()
    {
        $this->lastRoll = null;
    }

    /**
     * Randomize the number between 1 and 6.
     *
     * @return int
     */
    public function roll()
    {
        $roll = rand(1, $this->sides);
        $this->lastRoll = $roll;
        return $roll;
    }

    /**
     * Get last roll.
     *
     * @return int
     */
    public function getLastRoll() //unused
    {
        return $this->lastRoll;
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic() //unused
    {
        return "dice-" . $this->getLastRoll();
    }
}
