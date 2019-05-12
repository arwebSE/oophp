<?php

namespace ARWeb\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\ARWeb\Dice\Dice", $dice);
    }

    public function testRoll()
    {
        $dice = new Dice();

        $roll = $dice->roll();

        $this->assertThat($roll, $this->logicalAnd(
            $this->isType('int'),
            $this->greaterThan(0),
            $this->lessThan(7)
        ));
    }

    public function testLastRoll()
    {
        $dice = new Dice();

        $roll = $dice->roll();

        $lastRoll = $dice->getLastRoll();

        $this->assertEquals($roll, $lastRoll);
    }

    public function testGraphic()
    {
        $dice = new Dice();

        $dice->roll();

        $lastRoll = $dice->getLastRoll();
        $graphic = $dice->graphic();

        $this->assertEquals($graphic, "dice-" . $lastRoll);
    }
}
