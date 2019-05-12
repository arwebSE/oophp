<?php

namespace ARWeb\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObject()
    {
        $hand = new DiceHand();
        $this->assertInstanceOf("\ARWeb\Dice\DiceHand", $hand);
    }

    public function testSum()
    {
        $hand = new DiceHand();

        $hand->roll();

        $res = $hand->sum();

        $exp = $hand->values();
        $exp = array_sum($exp);
        $this->assertEquals($res, $exp);
    }

    public function testAvg()
    {
        $hand = new DiceHand();

        $hand->roll();

        $res = $hand->average();

        $this->assertNotNull($res);
    }
}
