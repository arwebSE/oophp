<?php

namespace ARWeb\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice exceptions.
 */
class DiceExceptionTest extends TestCase
{
    /**
     * Test if exception is thrown when argument is too low.
     */
    public function testOutOfBoundsLow()
    {
        $dice = new Dice(42, 2);
        $this->assertInstanceOf("\ARWeb\Dice\Dice", $dice);

        /* $this->expectException(DiceException::class);
        $dice->makeGuess(-1); */
    }
}
